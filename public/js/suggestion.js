$(document).ready(function() {
    var remoteHost;
    var checked = true;
    remoteHost = window.remoteHost;
    var htmlSuggestion = `
        <a href="{{ url }}" style="display: block;text-decoration: none;">
            <div class="search-title text-ellipsis">
                {{title}}
            </div>
            <div class="search-company text-ellipsis">
                {{company}}
            </div>
        </a>
    `;
    var titleHtml = '<div class="suggest-title" id="default-title">Tin xem nhiều nhất</div>'
    $.support.cors = true;
    var listJobs = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function (obj) { return obj.title; },
        remote: {
            url: remoteHost + '?q=%KEYWORD%',
            wildcard: '%KEYWORD%'
        }
    });

    var footerTmpl = Handlebars.compile('<div class="see-all text-ellipsis"><a href="{{ url }}{{ query }}">Xem tất cả kết quả tìm kiếm liên quan <strong>{{query}}<strong></a></div>');

    var footer = function(context) {
        var data = { 'query': context.query, 'url': window.searchUrl };
        return footerTmpl(data);
    }

    var htmlHeader = document.createElement('div');
    htmlHeader.classList.add('tag-suggest-content');
    window.featureTags.forEach( function (item, index) {
        var a = document.createElement('a');
        var text = document.createTextNode(item.name);
        a.setAttribute('href', item.url);
        a.appendChild(text);
        a.classList.add('btn', 'btn-default', 'btn-custom-tag');
        htmlHeader.appendChild(a);
    });
    htmlHeader = '<div class="search-header"><div class="suggest-title">Gợi ý từ khóa</div>' + htmlHeader.outerHTML + '</div>';

    var headerTmpl = Handlebars.compile(htmlHeader);
    var header = function(context) {
        var data = { 'query': context.query, 'featureTags': window.featureTags };
        return headerTmpl(data)
    }

    function nflTeamsWithDefaults(query, sync, async) {
        if (query === '') {
            checked = true;
            listJobs.search('', sync, async);
        } else {
            checked = false;
            listJobs.search(query, sync, async);
        }
    }

    var typeahead = $('.typeahead').typeahead({
        minLength: 0,
        highlight: true,
        limit: 10,
        classNames: {
            hint: 'is-hint',
            open: 'is-open',
            empty: 'is-empty',
            cursor: 'is-active',
            suggestion: 'Typeahead-suggestion',
            selectable: 'Typeahead-selectable',
        }
    }, {
        name: 'list-jobs',
        display: 'title',
        source: nflTeamsWithDefaults,
        templates: {
            suggestion: Handlebars.compile(htmlSuggestion),
            empty: [
                '<div class="empty-message text-gray text-ellipsis">',
                    'Không tìm thấy kết quả tìm kiếm',
                '</div>'
            ].join('\n'),
            header: header,
            footer: footer
        }
    });
    typeahead.bind('typeahead:render', function(ev, suggestion) {
        if (checked) {
            $('.search-header').show();
            $('.see-all').hide();
            $('.search-header').after(titleHtml);
        } else {
            $('.search-header').hide();
            $('.see-all').show();
            $('.search-header').remove();
        }
    });
});
