/* Professor Pritam Singh – AJAX site utilities */
'use strict';

/* ─── Utilities ────────────────────────────────────────────────────── */

function esc(str) {
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function formatDate(dateStr) {
    if (!dateStr) return '';
    try {
        const d = new Date(dateStr + 'T00:00:00');
        return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
    } catch (e) {
        return String(dateStr);
    }
}

function fetchJSON(url) {
    return fetch(url).then(function (r) {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
    });
}

function showLoading(el) {
    el.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading…</span></div></div>';
}

function showError(el, msg) {
    el.innerHTML = '<div class="alert alert-danger">' + esc(msg || 'Failed to load data.') + '</div>';
}

/* ─── Navigation ──────────────────────────────────────────────────── */

function buildNav(activePage) {
    var pages = {
        'index': 'index.html',
        'about': 'about.html',
        'education': 'education.html',
        'academic_career': 'academic_career.html',
        'awards': 'awards.html',
        'books': 'books.html',
        'articles': 'articles.html',
        'chapters': 'chapters.html',
        'reviews': 'reviews.html',
        'newspaper_articles': 'newspaper_articles.html',
        'conferences': 'conferences.html',
        'research_leadership': 'research_leadership.html',
        'funding': 'funding.html',
        'doctoral_supervision': 'doctoral_supervision.html',
        'professional_associations': 'professional_associations.html',
        'public_engagement': 'public_engagement.html',
        'academic_leadership': 'academic_leadership.html',
        'enterprise_consultancy': 'enterprise_consultancy.html',
        'global_impact': 'global_impact.html',
        'search': 'search.html',
        'contact': 'contact.html',
        'blog': 'blog.html',
        'videos': 'videos.html'
    };

    var profilePages = ['education', 'academic_career', 'awards'];
    var pubPages = ['books', 'articles', 'chapters', 'reviews', 'newspaper_articles'];
    var researchPages = ['research_leadership', 'funding', 'doctoral_supervision'];
    var engagePages = ['professional_associations', 'public_engagement', 'academic_leadership', 'enterprise_consultancy', 'global_impact'];

    function a(page, label, cls) {
        var active = activePage === page ? ' active' : '';
        var extraCls = cls ? ' ' + cls : '';
        return '<a class="' + extraCls.trim() + active + '" href="' + pages[page] + '">' + label + '</a>';
    }

    function isActiveIn(list) {
        return list.indexOf(activePage) !== -1 ? ' active' : '';
    }

    return '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">' +
        '<div class="container">' +
        '<a class="navbar-brand" href="index.html">Prof. Pritam Singh</a>' +
        '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">' +
        '<span class="navbar-toggler-icon"></span></button>' +
        '<div class="collapse navbar-collapse" id="navbarNav">' +
        '<ul class="navbar-nav ms-auto">' +
        '<li class="nav-item">' + a('index', 'Home', 'nav-link') + '</li>' +
        '<li class="nav-item">' + a('about', 'About', 'nav-link') + '</li>' +
        '<li class="nav-item dropdown">' +
        '<a class="nav-link dropdown-toggle' + isActiveIn(profilePages) + '" href="#" role="button" data-bs-toggle="dropdown">Profile</a>' +
        '<ul class="dropdown-menu">' +
        '<li>' + a('education', 'Education', 'dropdown-item') + '</li>' +
        '<li>' + a('academic_career', 'Academic Career', 'dropdown-item') + '</li>' +
        '<li>' + a('awards', 'Awards &amp; Honors', 'dropdown-item') + '</li>' +
        '</ul></li>' +
        '<li class="nav-item dropdown">' +
        '<a class="nav-link dropdown-toggle' + isActiveIn(pubPages) + '" href="#" role="button" data-bs-toggle="dropdown">Publications</a>' +
        '<ul class="dropdown-menu">' +
        '<li>' + a('books', 'Books', 'dropdown-item') + '</li>' +
        '<li>' + a('articles', 'Journal Articles', 'dropdown-item') + '</li>' +
        '<li>' + a('chapters', 'Book Chapters', 'dropdown-item') + '</li>' +
        '<li>' + a('reviews', 'Reviews', 'dropdown-item') + '</li>' +
        '<li>' + a('newspaper_articles', 'Newspaper Articles', 'dropdown-item') + '</li>' +
        '</ul></li>' +
        '<li class="nav-item">' + a('conferences', 'Conferences &amp; Talks', 'nav-link') + '</li>' +
        '<li class="nav-item dropdown">' +
        '<a class="nav-link dropdown-toggle' + isActiveIn(researchPages) + '" href="#" role="button" data-bs-toggle="dropdown">Research</a>' +
        '<ul class="dropdown-menu">' +
        '<li>' + a('research_leadership', 'Research Leadership', 'dropdown-item') + '</li>' +
        '<li>' + a('funding', 'Funding', 'dropdown-item') + '</li>' +
        '<li>' + a('doctoral_supervision', 'Doctoral Supervision', 'dropdown-item') + '</li>' +
        '</ul></li>' +
        '<li class="nav-item dropdown">' +
        '<a class="nav-link dropdown-toggle' + isActiveIn(engagePages) + '" href="#" role="button" data-bs-toggle="dropdown">Engagement</a>' +
        '<ul class="dropdown-menu">' +
        '<li>' + a('professional_associations', 'Professional Associations', 'dropdown-item') + '</li>' +
        '<li>' + a('public_engagement', 'Public Engagement', 'dropdown-item') + '</li>' +
        '<li>' + a('academic_leadership', 'Academic Leadership', 'dropdown-item') + '</li>' +
        '<li>' + a('enterprise_consultancy', 'Enterprise &amp; Consultancy', 'dropdown-item') + '</li>' +
        '<li>' + a('global_impact', 'Global Impact', 'dropdown-item') + '</li>' +
        '</ul></li>' +
        '<li class="nav-item">' + a('search', 'Search', 'nav-link') + '</li>' +
        '<li class="nav-item">' + a('contact', 'Contact', 'nav-link') + '</li>' +
        '</ul></div></div></nav>';
}

/* ─── Infinite Scroll ─────────────────────────────────────────────── */

function InfiniteLoader(items, renderFn, container, pageSize) {
    this.items = items;
    this.renderFn = renderFn;
    this.container = container;
    this.pageSize = pageSize || 10;
    this.offset = 0;
    this.busy = false;

    this.sentinel = document.createElement('div');
    this.sentinel.className = 'scroll-sentinel py-3 text-center text-muted';
    container.parentNode.insertBefore(this.sentinel, container.nextSibling);

    var self = this;
    this.observer = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting && !self.busy) {
            self.loadMore();
        }
    }, { rootMargin: '200px' });

    this.observer.observe(this.sentinel);
    this.loadMore();
}

InfiniteLoader.prototype.loadMore = function () {
    if (this.offset >= this.items.length) {
        this.observer.disconnect();
        this.sentinel.remove();
        return;
    }
    this.busy = true;
    var batch = this.items.slice(this.offset, this.offset + this.pageSize);
    var frag = document.createDocumentFragment();
    var self = this;
    batch.forEach(function (item) { self.renderFn(item, frag); });
    this.container.appendChild(frag);
    this.offset += this.pageSize;
    this.busy = false;

    if (this.offset < this.items.length) {
        this.sentinel.innerHTML = '<small>Scroll for more…</small>';
    } else {
        this.observer.disconnect();
        this.sentinel.remove();
    }
};

/* ─── Page initialisers ───────────────────────────────────────────── */

function initPage(pageId) {
    var navEl = document.getElementById('site-nav');
    if (navEl) navEl.innerHTML = buildNav(pageId);

    var loaders = {
        'index': loadIndex,
        'about': loadAbout,
        'blog': loadBlog,
        'articles': loadArticles,
        'books': loadBooks,
        'chapters': loadChapters,
        'conferences': loadConferences,
        'education': loadEducation,
        'awards': loadAwards,
        'academic_career': loadAcademicCareer,
        'academic_leadership': loadAcademicLeadership,
        'videos': loadVideos,
        'research_leadership': loadResearchLeadership,
        'doctoral_supervision': loadDoctoralSupervision,
        'funding': loadFunding,
        'global_impact': loadGlobalImpact,
        'newspaper_articles': loadNewspaperArticles,
        'professional_associations': loadProfessionalAssociations,
        'public_engagement': loadPublicEngagement,
        'enterprise_consultancy': loadEnterpriseConsultancy,
        'reviews': loadReviews,
        'search': initSearch,
        'contact': function () {} // static page
    };

    if (loaders[pageId]) loaders[pageId]();
}

/* ─── Index page ──────────────────────────────────────────────────── */

function loadIndex() {
    var el = document.getElementById('latest-updates');
    if (!el) return;
    showLoading(el);

    Promise.all([
        fetchJSON('data/books.json'),
        fetchJSON('data/articles.json'),
        fetchJSON('data/videos.json')
    ]).then(function (results) {
        var books = results[0].items || [];
        var articles = results[1].items || [];
        var videos = results[2].items || [];

        var latestBooks = books.slice(-2).reverse();
        var latestArticles = articles.slice(0, 2);
        var latestVideos = videos.slice(0, 1);

        var html = '';

        if (latestBooks.length) {
            html += '<h3 class="mt-4 mb-3">Recent Books</h3><div class="row">';
            latestBooks.forEach(function (b) {
                html += '<div class="col-md-6 mb-3"><div class="card"><div class="card-body">' +
                    '<h5 class="card-title">' + esc(b.title) + '</h5>' +
                    '<p class="meta-info">' + esc(b.authors) + ' (' + esc(b.year) + ')</p>' +
                    '<p class="card-text">' + esc(b.publisher) + '</p>' +
                    '</div></div></div>';
            });
            html += '</div>';
        }

        if (latestArticles.length) {
            html += '<h3 class="mt-4 mb-3">Recent Articles</h3><div class="row">';
            latestArticles.forEach(function (a) {
                html += '<div class="col-md-6 mb-3"><div class="card"><div class="card-body">' +
                    '<h5 class="card-title">' + esc(a.title) + '</h5>' +
                    '<p class="meta-info">' + esc(a.source) + ' &ndash; ' + esc(a.date) + '</p>' +
                    (a.summary ? '<p class="card-text">' + esc(a.summary) + '</p>' : '') +
                    '</div></div></div>';
            });
            html += '</div>';
        }

        if (latestVideos.length) {
            html += '<h3 class="mt-4 mb-3">Recent Videos</h3><div class="row">';
            latestVideos.forEach(function (v) {
                html += '<div class="col-md-12 mb-3"><div class="card"><div class="card-body">' +
                    '<h5 class="card-title">' + esc(v.title) + '</h5>' +
                    '<p class="meta-info">' + esc(v.channel) + ' &ndash; ' + esc(v.duration) + ' &ndash; ' + esc(v.published_date) + '</p>' +
                    '<a href="' + esc(v.url) + '" class="btn btn-sm btn-primary" target="_blank" rel="noopener">Watch Video</a>' +
                    '</div></div></div>';
            });
            html += '</div>';
        }

        el.innerHTML = html || '<p>No recent updates available.</p>';
    }).catch(function () {
        showError(el, 'Failed to load latest updates.');
    });
}

/* ─── About page ──────────────────────────────────────────────────── */

function loadAbout() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/bio.json').then(function (bio) {
        var html = '<div class="row">' +
            '<div class="col-lg-8">' +
            '<h2>' + esc(bio.name) + '</h2>' +
            '<h4 class="text-muted">' + esc(bio.title) + '</h4>' +
            '<h5 class="text-muted mb-4">' + esc(bio.institution) + '</h5>';

        html += '<div class="bio-section mb-4"><h3>Biography</h3><p>' + esc(bio.bio) + '</p></div>';

        if (bio.prior_positions && bio.prior_positions.length) {
            html += '<div class="positions-section mb-4"><h3>Prior Positions</h3><ul class="list-unstyled">';
            bio.prior_positions.forEach(function (p) {
                html += '<li class="mb-2"><i class="text-primary">&#10003;</i> ' + esc(p) + '</li>';
            });
            html += '</ul></div>';
        }

        if (bio.administrative_roles && bio.administrative_roles.length) {
            html += '<div class="achievements-section mb-4"><h3>Administrative Roles &amp; Honors</h3><ul class="list-unstyled">';
            bio.administrative_roles.forEach(function (r) {
                html += '<li class="mb-2"><i class="text-primary">&#10003;</i> ' + esc(r) + '</li>';
            });
            html += '</ul></div>';
        }

        if (bio.supervision) {
            html += '<div class="supervision-section mb-4"><h3>Doctoral Supervision</h3><p>' + esc(bio.supervision) + '</p></div>';
        }

        if (bio.education) {
            html += '<div class="education-section mb-4"><h3>Education</h3><ul class="list-unstyled">';
            Object.entries(bio.education).forEach(function (entry) {
                html += '<li class="mb-2"><i class="text-primary">&#127891;</i> <strong>' + esc(entry[0].replace('_', '/')) + '</strong> &ndash; ' + esc(entry[1]) + '</li>';
            });
            html += '</ul></div>';
        }

        if (bio.research_interests && bio.research_interests.length) {
            html += '<div class="research-section mb-4"><h3>Research Interests</h3><div class="d-flex flex-wrap gap-2">';
            bio.research_interests.forEach(function (i) {
                html += '<span class="badge bg-primary fs-6">' + esc(i) + '</span>';
            });
            html += '</div></div>';
        }

        if (bio.teaching_interests && bio.teaching_interests.length) {
            html += '<div class="teaching-section mb-4"><h3>Teaching Interests</h3><div class="d-flex flex-wrap gap-2">';
            bio.teaching_interests.forEach(function (i) {
                html += '<span class="badge bg-secondary fs-6">' + esc(i) + '</span>';
            });
            html += '</div></div>';
        }

        html += '<div class="profiles-section mb-4"><h3>Academic Profiles</h3><ul class="list-unstyled">';
        if (bio.institution_profile_url) html += '<li class="mb-2"><a href="' + esc(bio.institution_profile_url) + '" target="_blank" rel="noopener" class="text-decoration-none">&#128279; Oxford Brookes University Profile</a></li>';
        if (bio.google_scholar_url) html += '<li class="mb-2"><a href="' + esc(bio.google_scholar_url) + '" target="_blank" rel="noopener" class="text-decoration-none">&#128279; Google Scholar Profile</a></li>';
        if (bio.academia_url) html += '<li class="mb-2"><a href="' + esc(bio.academia_url) + '" target="_blank" rel="noopener" class="text-decoration-none">&#128279; Academia.edu Profile</a></li>';
        html += '</ul></div>';

        html += '</div><div class="col-lg-4"><div class="card"><div class="card-body">' +
            '<h5 class="card-title">Quick Links</h5><ul class="list-unstyled">' +
            '<li class="mb-2"><a href="books.html" class="text-decoration-none">&#128218; View Books</a></li>' +
            '<li class="mb-2"><a href="chapters.html" class="text-decoration-none">&#128214; View Book Chapters</a></li>' +
            '<li class="mb-2"><a href="articles.html" class="text-decoration-none">&#128196; View Articles</a></li>' +
            '<li class="mb-2"><a href="videos.html" class="text-decoration-none">&#127909; View Videos</a></li>' +
            '<li class="mb-2"><a href="conferences.html" class="text-decoration-none">&#127908; View Conferences</a></li>' +
            '<li class="mb-2"><a href="blog.html" class="text-decoration-none">&#128221; View Blog</a></li>' +
            '<li class="mb-2"><a href="contact.html" class="text-decoration-none">&#9993;&#65039; Contact</a></li>' +
            '</ul></div></div></div></div>';

        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load bio data.');
    });
}

/* ─── Blog page (infinite scroll) ────────────────────────────────── */

function renderBlogPost(post, container) {
    var div = document.createElement('div');
    div.className = 'article-item';
    var tags = '';
    if (post.tags && post.tags.length) {
        tags = '&nbsp;|&nbsp;' + post.tags.map(function (t) { return '<span class="badge bg-secondary">' + esc(t) + '</span>'; }).join(' ');
    }
    div.innerHTML = '<h3>' + esc(post.title) + '</h3>' +
        '<div class="meta-info mb-2"><strong>Date:</strong> ' + formatDate(post.date) + tags + '</div>' +
        (post.content ? '<p>' + esc(post.content) + '</p>' : '') +
        (post.url ? '<a href="' + esc(post.url) + '" class="btn btn-sm btn-primary" target="_blank" rel="noopener">Read More</a>' : '');
    container.appendChild(div);
}

function loadBlog() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/blog.json').then(function (data) {
        var posts = (data.items || []).slice().reverse();
        el.innerHTML = '';
        if (!posts.length) {
            el.innerHTML = '<div class="alert alert-info">No blog posts available at the moment. Check back soon.</div>';
            return;
        }
        new InfiniteLoader(posts, renderBlogPost, el, 10);
    }).catch(function () {
        showError(el, 'Failed to load blog posts.');
    });
}

/* ─── Articles page (infinite scroll) ────────────────────────────── */

function renderArticle(article, container) {
    var div = document.createElement('div');
    div.className = 'article-item';
    div.innerHTML = '<h3>' + esc(article.title) + '</h3>' +
        '<div class="meta-info mb-2">' +
        '<strong>Source:</strong> ' + esc(article.source) + '<br>' +
        '<strong>Date:</strong> ' + esc(article.date) +
        (article.authors ? '<br><strong>Authors:</strong> ' + esc(article.authors) : '') +
        '</div>' +
        (article.summary ? '<p>' + esc(article.summary) + '</p>' : '') +
        (article.url ? '<a href="' + esc(article.url) + '" class="btn btn-sm btn-primary" target="_blank" rel="noopener">Read Article</a>' : '');
    container.appendChild(div);
}

function loadArticles() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/articles.json').then(function (data) {
        var articles = data.items || [];
        el.innerHTML = '';
        if (!articles.length) {
            el.innerHTML = '<div class="alert alert-info">No articles available at the moment.</div>';
            return;
        }
        new InfiniteLoader(articles, renderArticle, el, 10);
    }).catch(function () {
        showError(el, 'Failed to load articles.');
    });
}

/* ─── Books page ──────────────────────────────────────────────────── */

function loadBooks() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/books.json').then(function (data) {
        var books = data.items || [];
        if (!books.length) {
            el.innerHTML = '<div class="alert alert-info">No books available at the moment.</div>';
            return;
        }
        var html = '';
        books.forEach(function (b) {
            html += '<div class="book-item">' +
                '<h3>' + esc(b.title) + '</h3>' +
                '<div class="meta-info mb-2">' +
                '<strong>Author(s):</strong> ' + esc(b.authors) + '<br>' +
                '<strong>Year:</strong> ' + esc(b.year) + '<br>' +
                '<strong>Publisher:</strong> ' + esc(b.publisher) + '<br>' +
                '<strong>ISBN:</strong> ' + esc(b.isbn) +
                '</div>' +
                (b.notes ? '<p>' + esc(b.notes) + '</p>' : '');
            if (b.links && b.links.length) {
                html += '<div class="mt-3"><strong>Links:</strong><br>';
                b.links.forEach(function (l) {
                    html += '<a href="' + esc(l.url) + '" class="btn btn-sm btn-primary me-2 mt-2" target="_blank" rel="noopener">' + esc(l.label) + '</a>';
                });
                html += '</div>';
            }
            html += '</div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load books.');
    });
}

/* ─── Book Chapters page ──────────────────────────────────────────── */

function loadChapters() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/chapters.json').then(function (data) {
        var chapters = data.items || [];
        if (!chapters.length) {
            el.innerHTML = '<div class="alert alert-info">No book chapters available at the moment.</div>';
            return;
        }
        var html = '';
        chapters.forEach(function (c) {
            html += '<div class="article-item">' +
                '<h3>' + esc(c.title) + '</h3>' +
                '<div class="meta-info mb-2">' +
                '<strong>Book:</strong> <em>' + esc(c.book) + '</em><br>' +
                (c.editors ? '<strong>Edited by:</strong> ' + esc(c.editors) + '<br>' : '') +
                '<strong>Author(s):</strong> ' + esc(c.authors) + '<br>' +
                (c.publisher ? '<strong>Publisher:</strong> ' + esc(c.publisher) + ' (' + esc(c.year) + ')' : '<strong>Year:</strong> ' + esc(c.year)) +
                '</div>' +
                (c.summary ? '<p>' + esc(c.summary) + '</p>' : '') +
                (c.url ? '<a href="' + esc(c.url) + '" class="btn btn-sm btn-primary" target="_blank" rel="noopener">View Chapter</a>' : '') +
                '</div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load book chapters.');
    });
}

/* ─── Conferences page ────────────────────────────────────────────── */

function loadConferences() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/conferences.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No conference presentations available at the moment.</div>';
            return;
        }

        var byYear = {};
        items.forEach(function (c) {
            var yr = String(c.date).slice(0, 4);
            if (!byYear[yr]) byYear[yr] = [];
            byYear[yr].push(c);
        });

        var years = Object.keys(byYear).sort(function (a, b) { return b - a; });
        var html = '';
        years.forEach(function (yr) {
            html += '<h3 class="mt-4 mb-3">' + esc(yr) + '</h3>';
            byYear[yr].forEach(function (c) {
                html += '<div class="article-item">' +
                    '<h5>' + esc(c.title) + '</h5>' +
                    '<div class="meta-info mb-2">' +
                    '<strong>Event:</strong> ' + esc(c.event) + '<br>' +
                    '<strong>Location:</strong> ' + esc(c.location) + '<br>' +
                    '<strong>Date:</strong> ' + formatDate(c.date) +
                    '</div>' +
                    (c.notes ? '<p>' + esc(c.notes) + '</p>' : '') +
                    '</div>';
            });
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load conference data.');
    });
}

/* ─── Education page ──────────────────────────────────────────────── */

function loadEducation() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/education.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No education data available.</div>';
            return;
        }
        var html = '<div class="row">';
        items.forEach(function (item) {
            html += '<div class="col-md-6 mb-4"><div class="card h-100"><div class="card-body">' +
                '<h3 class="card-title">' + esc(item.degree) + '</h3>' +
                '<h5 class="text-muted">' + esc(item.year) + '</h5>' +
                '<p class="mb-1"><strong>' + esc(item.institution) + '</strong></p>' +
                (item.notes ? '<p class="text-muted mt-2">' + esc(item.notes) + '</p>' : '') +
                '</div></div></div>';
        });
        html += '</div>';
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load education data.');
    });
}

/* ─── Awards page ─────────────────────────────────────────────────── */

function loadAwards() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/awards.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No awards data available.</div>';
            return;
        }

        var honorary = items.filter(function (i) { return i.category === 'honorary'; });
        var scholarships = items.filter(function (i) { return i.category === 'scholarship'; });
        var recognition = items.filter(function (i) { return i.category === 'recognition'; });

        function awardCards(list, badgeCls) {
            return list.map(function (item) {
                return '<div class="card mb-3"><div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                    '<p class="text-muted mb-0">' + esc(item.body) + '</p>' +
                    (item.notes ? '<p class="text-muted small mt-1">' + esc(item.notes) + '</p>' : '') +
                    '</div><span class="badge ' + badgeCls + ' ms-3">' + esc(item.year) + '</span>' +
                    '</div></div></div>';
            }).join('');
        }

        var html = '';
        if (honorary.length) html += '<h2 class="mt-4 mb-3">Honorary Awards</h2>' + awardCards(honorary, 'bg-warning text-dark');
        if (scholarships.length) html += '<h2 class="mt-4 mb-3">Scholarships &amp; Fellowships</h2>' + awardCards(scholarships, 'bg-primary');
        if (recognition.length) html += '<h2 class="mt-4 mb-3">External Recognition as Expert</h2>' + awardCards(recognition, 'bg-success');
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load awards data.');
    });
}

/* ─── Academic Career page ────────────────────────────────────────── */

function loadAcademicCareer() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/academic_career.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No career data available.</div>';
            return;
        }
        var html = '<div class="timeline">';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<div><h4 class="card-title mb-1">' + esc(item.title) + '</h4>' +
                '<h5 class="text-primary mb-1">' + esc(item.institution) + '</h5>' +
                (item.notes ? '<p class="text-muted mb-0">' + esc(item.notes) + '</p>' : '') +
                '</div><span class="badge bg-secondary fs-6 ms-3">' + esc(item.period) + '</span>' +
                '</div></div></div>';
        });
        html += '</div>';
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load academic career data.');
    });
}

/* ─── Academic Leadership page ───────────────────────────────────── */

function loadAcademicLeadership() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/academic_leadership.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No academic leadership data available.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<p class="mb-0">' + esc(item.description) + '</p>' +
                (item.period ? '<span class="badge bg-primary ms-3">' + esc(item.period) + '</span>' : '') +
                '</div></div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load academic leadership data.');
    });
}

/* ─── Videos page ─────────────────────────────────────────────────── */

function loadVideos() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/videos.json').then(function (data) {
        var videos = data.items || [];
        if (!videos.length) {
            el.innerHTML = '<div class="alert alert-info">No videos available at the moment.</div>';
            return;
        }
        var html = '';
        videos.forEach(function (v) {
            html += '<div class="video-item">' +
                '<h3>' + esc(v.title) + '</h3>' +
                '<div class="meta-info mb-2">' +
                '<strong>Platform:</strong> ' + esc(v.platform) + '<br>' +
                '<strong>Channel:</strong> ' + esc(v.channel) + '<br>' +
                '<strong>Duration:</strong> ' + esc(v.duration) + '<br>' +
                '<strong>Published:</strong> ' + esc(v.published_date) +
                '</div>' +
                (v.notes ? '<p>' + esc(v.notes) + '</p>' : '') +
                (v.url ? '<a href="' + esc(v.url) + '" class="btn btn-sm btn-primary" target="_blank" rel="noopener">Watch Video</a>' : '') +
                '</div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load videos.');
    });
}

/* ─── Research Leadership page ───────────────────────────────────── */

function loadResearchLeadership() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/research_leadership.json').then(function (data) {
        var editorial = data.editorial_positions || [];
        var review = data.review_activities || [];
        var html = '';

        if (editorial.length) {
            html += '<h2 class="mt-4 mb-3">Editorial Positions</h2>';
            editorial.forEach(function (item) {
                html += '<div class="card mb-3"><div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<div><h5 class="card-title mb-1">' + esc(item.role) + '</h5>' +
                    '<p class="text-muted mb-0">' + esc(item.organization) + '</p></div>' +
                    '<span class="badge bg-primary ms-3">' + esc(item.period) + '</span>' +
                    '</div></div></div>';
            });
        }

        if (review.length) {
            html += '<h2 class="mt-4 mb-3">Academic Review &amp; Referee Activities</h2>' +
                '<ul class="list-group">';
            review.forEach(function (activity) {
                html += '<li class="list-group-item">' + esc(activity) + '</li>';
            });
            html += '</ul>';
        }

        el.innerHTML = html || '<div class="alert alert-info">No data available.</div>';
    }).catch(function () {
        showError(el, 'Failed to load research leadership data.');
    });
}

/* ─── Doctoral Supervision page ──────────────────────────────────── */

function loadDoctoralSupervision() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/doctoral_supervision.json').then(function (data) {
        var completed = data.completed || [];
        var current = data.current || [];
        var external = data.external_examination || '';
        var html = '';

        function dsCards(list, badgeCls, badgeLabel) {
            var out = '<div class="row">';
            list.forEach(function (item) {
                out += '<div class="col-md-6 mb-3"><div class="card h-100"><div class="card-body">' +
                    '<h5 class="card-title mb-1">' + esc(item.student) + '</h5>' +
                    '<p class="card-text text-muted"><em>' + esc(item.thesis) + '</em></p>' +
                    '<div class="mt-2"><span class="badge ' + badgeCls + '">' + badgeLabel + (item.year_completed ? ' ' + esc(item.year_completed) : '') + '</span></div>' +
                    (item.notes ? '<p class="text-muted small mt-2 mb-0">' + esc(item.notes) + '</p>' : '') +
                    '</div></div></div>';
            });
            return out + '</div>';
        }

        if (completed.length) html += '<h2 class="mt-4 mb-3">Successfully Completed Doctoral Students</h2>' + dsCards(completed, 'bg-success', 'Completed');
        if (current.length) html += '<h2 class="mt-4 mb-3">Current Doctoral Students</h2>' + dsCards(current, 'bg-primary', 'In Progress');
        if (external) html += '<h2 class="mt-4 mb-3">External Examination</h2><div class="card"><div class="card-body"><p class="mb-0">' + esc(external) + '</p></div></div>';

        el.innerHTML = html || '<div class="alert alert-info">No data available.</div>';
    }).catch(function () {
        showError(el, 'Failed to load doctoral supervision data.');
    });
}

/* ─── Funding page ────────────────────────────────────────────────── */

function loadFunding() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/funding.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No funding data available.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                '<p class="text-primary mb-1"><strong>' + esc(item.funder) + '</strong></p>' +
                (item.notes ? '<p class="text-muted small mb-0">' + esc(item.notes) + '</p>' : '') +
                '</div><div class="text-end ms-3">' +
                '<span class="badge bg-success d-block mb-1">' + esc(item.amount) + '</span>' +
                '<span class="badge bg-secondary">' + esc(item.year) + '</span>' +
                '</div></div></div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load funding data.');
    });
}

/* ─── Global Impact page ──────────────────────────────────────────── */

function loadGlobalImpact() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/global_impact.json').then(function (data) {
        var visiting = data.visiting_positions || [];
        var conferences = data.international_conferences_organised || [];
        var translations = data.translations || [];
        var panels = data.panels_chaired || '';
        var html = '';

        if (visiting.length) {
            html += '<h2 class="mt-4 mb-3">Visiting Positions</h2>';
            visiting.forEach(function (item) {
                html += '<div class="card mb-3"><div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                    '<p class="text-muted mb-0">' + esc(item.institution) + '</p>' +
                    (item.notes ? '<p class="text-muted small mt-1 mb-0">' + esc(item.notes) + '</p>' : '') +
                    '</div><span class="badge bg-primary ms-3">' + esc(item.year) + '</span>' +
                    '</div></div></div>';
            });
        }

        if (conferences.length) {
            html += '<h2 class="mt-4 mb-3">International Conferences Organised</h2>';
            conferences.forEach(function (item) {
                html += '<div class="card mb-3"><div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                    '<p class="text-muted mb-0">' + esc(item.event) + ' &mdash; ' + esc(item.location) + '</p>' +
                    (item.notes ? '<p class="text-muted small mt-1 mb-0">' + esc(item.notes) + '</p>' : '') +
                    '</div><span class="badge bg-secondary ms-3">' + esc(item.year) + '</span>' +
                    '</div></div></div>';
            });
        }

        if (translations.length) {
            html += '<h2 class="mt-4 mb-3">Translations of Work</h2><ul class="list-group mb-4">';
            translations.forEach(function (item) {
                html += '<li class="list-group-item"><span class="badge bg-info me-2">' + esc(item.year) + '</span>' + esc(item.description) + '</li>';
            });
            html += '</ul>';
        }

        if (panels) {
            html += '<h2 class="mt-4 mb-3">Panels Chaired</h2><div class="card"><div class="card-body"><p class="mb-0">' + esc(panels) + '</p></div></div>';
        }

        el.innerHTML = html || '<div class="alert alert-info">No data available.</div>';
    }).catch(function () {
        showError(el, 'Failed to load global impact data.');
    });
}

/* ─── Newspaper Articles page ────────────────────────────────────── */

function loadNewspaperArticles() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/newspaper_articles.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No newspaper articles available at the moment.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                '<p class="text-muted mb-0"><em>' + esc(item.publication) + '</em></p>' +
                (item.notes ? '<p class="text-muted small mt-1">' + esc(item.notes) + '</p>' : '') +
                '</div><span class="badge bg-secondary ms-3">' + esc(item.year) + '</span>' +
                '</div></div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load newspaper articles.');
    });
}

/* ─── Professional Associations page ─────────────────────────────── */

function loadProfessionalAssociations() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/professional_associations.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No professional association data available.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<div><h5 class="card-title mb-1">' + esc(item.role) + '</h5>' +
                '<p class="text-muted mb-0">' + esc(item.organization) + '</p>' +
                (item.notes ? '<p class="text-muted small mt-1 mb-0">' + esc(item.notes) + '</p>' : '') +
                '</div><span class="badge bg-primary ms-3">' + esc(item.period) + '</span>' +
                '</div></div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load professional associations data.');
    });
}

/* ─── Public Engagement page ──────────────────────────────────────── */

function loadPublicEngagement() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/public_engagement.json').then(function (data) {
        var media = data.media_appearances || [];
        var lectures = data.public_lectures || [];
        var community = data.community_activities || [];
        var html = '';

        if (media.length) {
            html += '<h2 class="mt-4 mb-3">Media Appearances (Selected)</h2>';
            media.forEach(function (item) {
                html += '<div class="card mb-2"><div class="card-body py-2">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<p class="mb-0">' + esc(item.description) + '</p>' +
                    '<span class="badge bg-secondary ms-3">' + esc(item.year) + '</span>' +
                    '</div></div></div>';
            });
        }

        if (lectures.length) {
            html += '<h2 class="mt-4 mb-3">Public Lectures (Selected)</h2>';
            lectures.forEach(function (item) {
                html += '<div class="card mb-3"><div class="card-body">' +
                    '<div class="d-flex justify-content-between align-items-start">' +
                    '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                    '<p class="text-muted mb-0">' + esc(item.location) + '</p></div>' +
                    '<span class="badge bg-info ms-3">' + esc(item.year) + '</span>' +
                    '</div></div></div>';
            });
        }

        if (community.length) {
            html += '<h2 class="mt-4 mb-3">Community Engagement</h2><ul class="list-group">';
            community.forEach(function (activity) {
                html += '<li class="list-group-item">' + esc(activity) + '</li>';
            });
            html += '</ul>';
        }

        el.innerHTML = html || '<div class="alert alert-info">No data available.</div>';
    }).catch(function () {
        showError(el, 'Failed to load public engagement data.');
    });
}

/* ─── Enterprise & Consultancy page ──────────────────────────────── */

function loadEnterpriseConsultancy() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/enterprise_consultancy.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No enterprise and consultancy data available.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<h5 class="card-title mb-1">' + esc(item.client) + '</h5>' +
                '<p class="card-text text-muted">' + esc(item.description) + '</p>' +
                '</div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load enterprise & consultancy data.');
    });
}

/* ─── Reviews page ────────────────────────────────────────────────── */

function loadReviews() {
    var el = document.getElementById('page-content');
    if (!el) return;
    showLoading(el);

    fetchJSON('data/reviews.json').then(function (data) {
        var items = data.items || [];
        if (!items.length) {
            el.innerHTML = '<div class="alert alert-info">No reviews available at the moment.</div>';
            return;
        }
        var html = '';
        items.forEach(function (item) {
            html += '<div class="card mb-3"><div class="card-body">' +
                '<div class="d-flex justify-content-between align-items-start">' +
                '<div><h5 class="card-title mb-1">' + esc(item.title) + '</h5>' +
                '<p class="text-muted mb-1"><em>' + esc(item.source) + '</em></p>' +
                (item.notes ? '<p class="text-muted small mb-0">' + esc(item.notes) + '</p>' : '') +
                '</div><span class="badge bg-secondary ms-3">' + esc(item.year) + '</span>' +
                '</div></div></div>';
        });
        el.innerHTML = html;
    }).catch(function () {
        showError(el, 'Failed to load reviews.');
    });
}

/* ─── Search page ─────────────────────────────────────────────────── */

function initSearch() {
    var form = document.getElementById('search-form');
    var resultsEl = document.getElementById('search-results');
    var queryInput = document.getElementById('search-query');
    if (!form || !resultsEl || !queryInput) return;

    var params = new URLSearchParams(window.location.search);
    var initialQuery = params.get('q') || '';
    if (initialQuery) {
        queryInput.value = initialQuery;
        runSearch(initialQuery, resultsEl);
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var q = queryInput.value.trim();
        if (q) {
            history.replaceState(null, '', '?q=' + encodeURIComponent(q));
            runSearch(q, resultsEl);
        }
    });
}

function runSearch(query, resultsEl) {
    showLoading(resultsEl);
    var q = query.toLowerCase();

    Promise.all([
        fetchJSON('data/books.json'),
        fetchJSON('data/articles.json'),
        fetchJSON('data/chapters.json'),
        fetchJSON('data/conferences.json'),
        fetchJSON('data/newspaper_articles.json'),
        fetchJSON('data/blog.json')
    ]).then(function (datasets) {
        var results = [];

        (datasets[0].items || []).forEach(function (item) {
            if ((item.title + ' ' + item.authors + ' ' + (item.notes || '')).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Book', title: item.title, meta: item.authors + ' (' + item.year + ')', url: 'books.html' });
            }
        });

        (datasets[1].items || []).forEach(function (item) {
            if ((item.title + ' ' + item.source + ' ' + (item.summary || '')).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Journal Article', title: item.title, meta: item.source + ' (' + item.date + ')', url: 'articles.html' });
            }
        });

        (datasets[2].items || []).forEach(function (item) {
            if ((item.title + ' ' + (item.book || '') + ' ' + (item.editors || '')).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Book Chapter', title: item.title, meta: (item.book || '') + ' (' + item.year + ')', url: 'chapters.html' });
            }
        });

        (datasets[3].items || []).forEach(function (item) {
            if ((item.title + ' ' + item.event + ' ' + item.location).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Conference', title: item.title, meta: item.event + ', ' + item.location, url: 'conferences.html' });
            }
        });

        (datasets[4].items || []).forEach(function (item) {
            if ((item.title + ' ' + item.publication).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Newspaper Article', title: item.title, meta: item.publication + ' (' + item.year + ')', url: 'newspaper_articles.html' });
            }
        });

        (datasets[5].items || []).forEach(function (item) {
            if ((item.title + ' ' + (item.content || '') + ' ' + (item.tags || []).join(' ')).toLowerCase().indexOf(q) !== -1) {
                results.push({ type: 'Blog Post', title: item.title, meta: item.source + ' (' + item.date + ')', url: 'blog.html' });
            }
        });

        var count = results.length;
        var html = '<p class="text-muted mb-3">' + count + ' result' + (count !== 1 ? 's' : '') + ' for &ldquo;' + esc(query) + '&rdquo;</p>';

        if (!count) {
            html += '<div class="alert alert-info">No results found. Try different keywords.</div>';
        } else {
            results.forEach(function (r) {
                html += '<div class="card mb-3"><div class="card-body">' +
                    '<span class="badge bg-primary mb-1">' + esc(r.type) + '</span>' +
                    '<h5 class="card-title mb-1"><a href="' + esc(r.url) + '" class="text-decoration-none">' + esc(r.title) + '</a></h5>' +
                    '<p class="text-muted small mb-0">' + esc(r.meta) + '</p>' +
                    '</div></div>';
            });
        }

        resultsEl.innerHTML = html;
    }).catch(function () {
        showError(resultsEl, 'Search failed. Please try again.');
    });
}
