<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog') | Aplikasi Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            --accent-color: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar-blog {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
            padding: 1rem 0;
        }

        .navbar-blog .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white !important;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .navbar-blog .navbar-brand:hover {
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-blog .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            margin-left: 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }

        .navbar-blog .nav-link:hover,
        .navbar-blog .nav-link.active {
            color: white !important;
            border-bottom-color: rgba(255, 255, 255, 0.8);
        }

        /* Main Container */
        .container-main {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1rem;
        }

        /* Article Card */
        .article-card {
            background: white;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.15);
        }

        .article-card .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .article-card .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-card:hover .article-image img {
            transform: scale(1.05);
        }

        .article-card .card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .article-card .article-category {
            display: inline-block;
            background: var(--accent-color);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            width: fit-content;
            transition: all 0.3s ease;
        }

        .article-card:hover .article-category {
            background: var(--primary-color);
        }

        .article-card .article-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            flex: 1;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }

        .article-card .article-title:hover {
            color: var(--primary-color);
        }

        .article-card .article-excerpt {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card .article-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .article-card .author-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-card .author-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 2rem;
        }

        .sidebar-widget {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .sidebar-widget h5 {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.25rem;
            color: var(--text-dark);
            position: relative;
            padding-bottom: 0.75rem;
        }

        .sidebar-widget h5:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }

        .category-list {
            list-style: none;
        }

        .category-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .category-list li:last-child {
            border-bottom: none;
        }

        .category-list a {
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .category-list a:hover {
            color: var(--primary-color);
            padding-left: 0.5rem;
            font-weight: 500;
        }

        .category-list .badge {
            background: var(--primary-color);
            color: white;
            border-radius: 12px;
            padding: 0.35rem 0.6rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .category-list a.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Footer */
        .footer-blog {
            background: linear-gradient(135deg, var(--text-dark) 0%, #374151 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
            text-align: center;
        }

        .footer-blog p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .pagination .page-link {
            color: var(--primary-color);
            border-color: var(--border-color);
            border-radius: 6px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* No articles message */
        .no-articles {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-light);
        }

        .no-articles i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-main {
                margin: 1.5rem auto;
            }

            .article-card .article-title {
                font-size: 1rem;
            }

            .sidebar {
                position: static;
                margin-top: 2rem;
            }

            .navbar-blog .nav-link {
                margin-left: 0;
                padding: 0.5rem 0;
            }

            .article-card {
                margin-bottom: 1rem;
            }
        }

        /* Loading animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .article-card {
            animation: fadeIn 0.5s ease forwards;
        }

        .article-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .article-card:nth-child(3) {
            animation-delay: 0.2s;
        }

        .article-card:nth-child(4) {
            animation-delay: 0.3s;
        }

        .article-card:nth-child(5) {
            animation-delay: 0.4s;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-blog">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog.index') }}">
                <i class="fas fa-book-reader"></i> Blog
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.index') }}">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-main">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer-blog">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <h5 style="color: white; margin-bottom: 1rem;">Aplikasi Blog</h5>
                    <p>Platform berbagi artikel dan cerita dari penulis berbakat</p>
                </div>
            </div>
            <div class="row text-center py-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <div class="col-12">
                    <p>&copy; {{ date('Y') }} Aplikasi Blog. Hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>