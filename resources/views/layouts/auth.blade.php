<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'yawOuch')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* all your shared CSS variables, theme rules and styles */
        :root {
            --bg: #0f1224;
            --card: #1b1b2f;
            --muted: #aeb0c3;
            --primary-1: #6b4eff;
            --primary-2: #9c6fff;
            --accent: #00d6a5;
            --input-bg: #26283a;
            --text: #fff;
            --header-text: #fff;
            --btn-outline: rgba(255, 255, 255, 0.15);
        }

        [data-theme="light"] {
            --bg: #f4f6f9;
            --card: #fff;
            --muted: #6b7280;
            --primary-1: #4f46e5;
            --primary-2: #7c3aed;
            --accent: #06b6d4;
            --input-bg: #f1f5f9;
            --text: #0f1724;
            --header-text: #fff;
            --btn-outline: rgba(15, 23, 36, 0.08);
        }

        html,
        body {
            height: 100%
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0
        }

        .card {
            background: var(--card);
            border: none;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(3, 6, 23, 0.6);
            max-width: 420px
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-1), var(--primary-2));
            color: var(--header-text);
            font-weight: 700;
            font-size: 1.05rem;
            padding: 12px 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: space-between;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .logo {
            max-height: 56px
        }

        #theme-toggle {
            width: 44px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            border: 1px solid var(--btn-outline);
            background: transparent;
            color: var(--text);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px
        }

        .form-label {
            color: var(--text) !important;
            font-weight: 600
        }

        .form-control {
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.03);
            color: var(--text);
            transition: border-color .15s, box-shadow .15s
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.35)
        }

        [data-theme="light"] .form-control::placeholder {
            color: rgba(15, 23, 36, 0.45)
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(0, 214, 165, 0.12);
            border-color: var(--accent);
            outline: none
        }

        .btn-primary {
            background: linear-gradient(180deg, var(--primary-1), var(--primary-2));
            border: none;
            color: #fff;
            font-weight: 600
        }

        .card-body small {
            color: var(--muted)
        }

        .card-body .text-muted {
            color: var(--muted) !important
        }

        .btn-outline-light {
            color: var(--text) !important;
            border-color: var(--btn-outline) !important;
            background: transparent !important
        }

        .text-center .btn-outline-light {
            padding: .25rem .6rem;
            font-size: .85rem
        }

        @media (max-width:576px) {
            .card {
                margin: 15px;
                max-width: 100%
            }

            .card-header {
                flex-direction: column;
                text-align: center;
                gap: 8px;
                align-items: center
            }

            #theme-toggle {
                margin-top: 6px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="header-left">
                            <img src="{{ asset('images/yawouch.png') }}" alt="Logo" class="logo">
                            <div class="title">
                                <div class="main">@yield('card_title', 'YawOuch')</div>
                                <div class="sub">@yield('card_sub')</div>
                            </div>
                        </div>

                        <button id="theme-toggle" type="button" aria-pressed="false" title="Toggle theme">
                            <span id="theme-icon">🌙</span>
                        </button>
                    </div>

                    <div class="card-body">
                        @yield('card_body')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const btn = document.getElementById('theme-toggle');
            const icon = document.getElementById('theme-icon');
            function current() { return document.documentElement.getAttribute('data-theme') || 'dark'; }
            function apply(t) { document.documentElement.setAttribute('data-theme', t); localStorage.setItem('theme', t); btn.setAttribute('aria-pressed', t === 'light'); icon.textContent = t === 'light' ? '☀️' : '🌙'; }
            btn.addEventListener('click', () => apply(current() === 'dark' ? 'light' : 'dark'));
            apply(current());
        })();
    </script>
</body>

</html>