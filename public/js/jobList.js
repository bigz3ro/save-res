function instanceJobList(options)
{
    var _defaultJobs = [];
    var _defaultFilters = [];
    if (options.jobs) {
        _defaultJobs = options.jobs;
    }
    if (options.defaultFilters) {
        _defaultFilters = options.defaultFilters;
    }
    var _can_load_more = true;
    if (options.can_load_more == false) {
        _can_load_more = options.can_load_more;
    }
    return new Vue({
        el: options['el'],
        data: {
            window: window,
            jobs: _defaultJobs,
            can_load_more: _can_load_more,
            is_load_more_loading: false,
            is_filter_loading: false,
            filter_params: _defaultFilters,
            filter_callback: null,
        },
        mounted: function () {
            $(window).on("scroll", function() {
                var scrollHeight = $(document).height();
                var scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    jobList.loadMore();
                }
            });

            ApproachJob.init();
        },
        computed: {
            last_uptop_at: function () {
                if (jobList.jobs.length == 0) return '';
                return jobList.jobs[jobList.jobs.length - 1].uptop_at;
            },
            job_ids: function () {
                var ids = [];
                for (var i = 0; i < jobList.jobs.length; i++) {
                    ids.push(jobList.jobs[i].id);
                }
                return ids;
            }
        },
        watch: {
        },
        methods: {
            refreshFBXFBML: function (jobs) {
                if (!window.FB) return false;
                if (jobs == undefined) {
                    // refresh all
                    window.FB.XFBML.parse($('#job-list').get(0));
                } else {
                    for (var i = 0; i < jobs.length; i++) {
                        // console.log('Refresh #job-item-' + jobs[i].id);
                        window.FB.XFBML.parse($('#job-item-' + jobs[i].id).get(0));
                    }
                }
            },
            expandJob: function (job) {
                //call ajax update view_count
                axios.post(window.data.route['job.update-view-count'], {id: job.id}).then(function (response) {

                });
                job.is_feed_text_collapsed = false;
            },
            // Edit job
            showEditJobEditor: function (job) {
                editJobEditor.showEditor(job, function updateJob(updatedJob) {
                    jobList.editJob(updatedJob);
                });
            },
            // Report job
            showReportJobEditor : function (job) {
                reportJobEditor.showEditor(job);
            },
            editJob: function (job) {
                for (var i = 0; i < this.jobs.length; i++) {
                    if (this.jobs[i].id == job.id) {
                        var isChangeUrl = this.jobs[i].detail_url != job.detail_url;
                        this.$set(this.jobs, i, job);
                        if (isChangeUrl) {
                            this.$nextTick(function () {
                                // Refresh FB XFBML
                                this.refreshFBXFBML([job]);
                            });
                        }
                        break;
                    }
                }
            },
            // Delete job
            showConfirmDeleteJob : function (job) {
                confirmModal.showConfirm('Bạn có chắc chắn muốn xóa đăng tin tuyển dụng này?', 'danger', function (job) {
                    // Delete job
                    jobList.ajaxDeleteJob(job);
                }, null, job);
            },
            ajaxDeleteJob: function (job) {
                if (ajaxLock) return false;
                ajaxLock = true;
                axios.post(window.data.route['job.ajax-delete'], {id: job.id}).then(function (response) {
                    ajaxLock = false;
                    if (response.data.status == 'success') {
                        jobList.deleteJob(job);
                        toastr.success('Xóa tin thành công!', 'Thông báo');
                    } else {
                        toastr.error(response.data.message);
                    }
                }).catch(function (error) {
                    ajaxLock = false;
                    toastr.error('Có lỗi xảy ra, bạn vui lòng làm mới trang và thử lại!');
                });
            },
            deleteJob: function (job) {
                for (var i = 0; i < this.jobs.length; i++) {
                    if (this.jobs[i].id == job.id) {
                        this.jobs[i] = job;
                        this.jobs.splice(i, 1);
                        break;
                    }
                }
            },
            // Load job
            getLoadMoreParams: function () {
                return $.extend(this.filter_params, {
                    last_uptop_at: this.last_uptop_at,
                    excludes: this.job_ids
                });
            },
            sendFilter: function (params, callback) {
                this.filter_params = params;
                this.filter_callback = callback;
                this.filter();
            },
            filter: function () {
                if (this.is_filter_loading) return false;
                Loading.show();
                // console.log(params.excludes);
                axios.get(window.data.route['job.ajax-load'], {params: this.filter_params}).then(function (response) {
                    Loading.hide();
                    ajaxLock = false;
                    $("#searchTitle").text("Kết quả tìm kiếm");
                    if (response.data.status == 'success') {
                        jobList.reloadJobs(response.data.jobs);
                        jobList.$nextTick(function () {
                            // Wait for rendering done before turn off loading!
                            jobList.is_filter_loading = false;
                            scrollTop();
                        });
                        if (jobList.filter_callback) {
                            // Callback & Reset callback
                            jobList.filter_callback();
                            jobList.filter_callback = null;
                        }
                    } else {
                        jobList.is_filter_loading = false;
                        toastr.error(response.data.message);
                    }
                }).catch(function (error) {
                    jobList.is_filter_loading = false;
                    ajaxLock = false;
                    toastr.error('Có lỗi xảy ra, bạn vui lòng làm mới trang và thử lại!');
                });
            },
            loadMore: function () {
                if (!this.can_load_more || this.is_load_more_loading) return false;
                var params = this.getLoadMoreParams();
                // console.log(params.excludes);
                this.is_load_more_loading = true;
                axios.get(window.data.route['job.ajax-load'], {params: params}).then(function (response) {
                    ajaxLock = false;
                    if (response.data.status == 'success') {
                        if (response.data.jobs.length) {
                            jobList.appendJobs(response.data.jobs);
                            jobList.$nextTick(function () {
                                // Wait for rendering done before turn off loading!
                                jobList.is_load_more_loading = false;
                            });
                        } else {
                            jobList.is_load_more_loading = false;
                            jobList.can_load_more = false;
                        }
                    } else {
                        jobList.is_load_more_loading = false;
                        toastr.error(response.data.message);
                    }
                }).catch(function (error) {
                    jobList.is_load_more_loading = false;
                    ajaxLock = false;
                    toastr.error('Có lỗi xảy ra, bạn vui lòng làm mới trang và thử lại!');
                });
            },
            appendJobs: function (jobs)
            {
                this.jobs.push.apply(this.jobs, jobs);
                this.$nextTick(function () {
                    jobList.refreshFBXFBML(jobs);
                });
            },
            reloadJobs: function (jobs)
            {
                this.jobs = jobs;
                if (jobs.length) {
                    this.$nextTick(function () {
                        jobList.refreshFBXFBML();
                    });
                }
            },
            upTopJob: function (job) {
                if (ajaxLock) return false;
                ajaxLock = true;
                axios.post(window.data.route['job.ajax-uptop'], {id: job.id}).then(function (response) {
                    ajaxLock = false;
                    if (response.data.status == 'success') {
                        toastr.success('Uptop thành công!', 'Thông báo');
                    } else {
                        toastr.error(response.data.message);
                    }
                }).catch(function (error) {
                    ajaxLock = false;
                    toastr.error('Có lỗi xảy ra, bạn vui lòng làm mới trang và thử lại!');
                });
            },
            applyJob: function (job) {
                toastr.remove();
                var vm = this;
                if (!window.auth.check()) {
                    this.showApplyModal(job);
                } else if (window.auth.check() && !window.auth.isFinishedProfile) {
                    this.showUpdateProfile(job);
                } else {
                    confirmModal.showConfirm('Bạn có chắc chắn muốn nhận công việc này?', 'info', function () {
                        axios.post(window.data.route['job.ajax-apply-job'], {id: job.id}).then(function (response) {
                            ajaxLock = false;
                            if (response.data.status == 'success') {
                                vm.updateListJob(response.data.job);
                                toastr.success(response.data.message, "Thông báo");
                            } else {
                                toastr.error(response.data.message, "Lỗi");
                            }
                        }).catch(function (error) {
                            ajaxLock = false;
                            toastr.error('Có lỗi xảy ra, bạn vui lòng làm mới trang và thử lại!', 'Thông báo');
                        });
                    });
                }
            },
            showUpdateProfile: function (job) {
                if (typeof updateProfileModal !== 'undefined') {
                    updateProfileModal.show(job);
                }
            },
            showApplyModal: function(job) {
                if (typeof applyModal !== 'undefined') {
                    applyModal.show(job);
                }
            },
            updateListJob: function (job) {
                for (var i = 0; i < this.jobs.length; i++ ) {
                    if (this.jobs[i].id === job.id) {
                        this.$set(this.jobs, i, job);
                        break;
                    }
                }
            },
            shareJob: function (job) {
                $('#modal-share #share-url').val(job.detail_url);
                $('#modal-share #facebook-share-url').attr("href", job.fb_share_url);
                $('#modal-share #twitter-share-url').attr("href", "https://twitter.com/share?url=" + job.detail_url + "&title=" + job.title);
                $('#modal-share #google-plus-share-url').attr("href", "https://plus.google.com/share?url=" + job.detail_url);
                $('#modal-share').modal('show');
            },
            upCallCount: function (jobId) {
                var url = window.data.route['job.ajax-up-call-count'];
                var data = {
                    job_id: jobId
                };
                axios.post(url, data).then(function (response) {
                });
            },
            showJobPhone: function (job) {
                $(".job-phone-" + job.id).show();
                $(".btn-apply-" + job.id).hide();
                $('#apply-info').css('visibility', 'visible');
                this.upCallCount(job.id);
                if (!window.auth.check() && applyModal.isShowAgain) {
                    jobList.showApplyModal(job);
                } else if (!window.auth.check() && applyModal.isShowAgain == false) {
                    $('.btn-apply-modal-' + job.id).css('display', 'block');
                    $('.hide-element').css('display', 'none');
                } else {
                    $('.btn-apply-modal-' + job.id).css('display', 'block');
                }
            }
        }
    });
    return jobList;
}

var ApproachJob = {
    jobs: [],
    currentTop: 0,
    windowHeight: $(window).height(),

    init: function () {
        ApproachJob.listenApproach();

        $(document).scroll(function(event) {
            var windowTop = $(this).scrollTop();

            if (Math.abs(windowTop - ApproachJob.currentTop) > 200) {
                ApproachJob.currentTop = windowTop;
                ApproachJob.listenApproach();
            }
        });

        setInterval(function () {
            ApproachJob.push();
        }, 10000);
    },

    listenApproach: function () {
        // console.log("Window top: ", ApproachJob.currentTop);
        $("#job-list .job-item").not(".approached").each(function(index, el) {
            var jobId = $(el).attr('data-id');
            var jobPositionTop = $(el).position().top + 16;

            if (!jobId) {
                return;
            }

            // console.log(jobPositionTop, ApproachJob.currentTop + ApproachJob.windowHeight - 100);
            if (jobPositionTop >= ApproachJob.currentTop && jobPositionTop < ApproachJob.currentTop + ApproachJob.windowHeight - 100) {
                $(el).addClass('approached');
                ApproachJob.jobs.push(jobId);
                // console.log("Approached: ", jobId);
            }
        });
    },

    push: function () {
        // console.log("Push: ", ApproachJob.jobs);
        if (ApproachJob.jobs.length) {
            axios.post(window.data.route['job.approach'], {"jobs": ApproachJob.jobs});
            ApproachJob.jobs = [];
        }
    }
}
