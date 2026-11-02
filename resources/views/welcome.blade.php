<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CampusMind</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eff6ff 0%, #fdf2f8 50%, #f5f3ff 100%);
            color: #0f172a;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px 64px;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        .brand {
            font-weight: 800;
            font-size: 2rem;
            color: #1d4ed8;
        }
        .links a {
            margin-left: 10px;
            text-decoration: none;
            color: #0f172a;
            border: 1px solid rgba(37,99,235,0.15);
            border-radius: 999px;
            padding: 10px 18px;
            background: rgba(255,255,255,0.8);
            font-weight: 600;
        }
        .hero {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 30px;
            align-items: center;
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(37,99,235,0.12);
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        }
        .badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(37,99,235,0.08);
            color: #1d4ed8;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
        }
        h1 {
            font-size: clamp(2.5rem, 5vw, 4.2rem);
            letter-spacing: -0.05em;
            margin: 18px 0;
            line-height: 1.08;
        }
        .lead {
            color: #475569;
            font-size: 1.08rem;
            line-height: 1.7;
            margin-bottom: 22px;
        }
        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }
        .btn {
            text-decoration: none;
            border-radius: 14px;
            padding: 14px 22px;
            font-weight: 700;
            display: inline-block;
        }
        .btn.primary {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            box-shadow: 0 12px 24px rgba(37,99,235,0.22);
        }
        .btn.secondary {
            border: 1px solid rgba(37,99,235,0.12);
            background: white;
            color: #0f172a;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        .stat {
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(37,99,235,0.08);
            border-radius: 18px;
            padding: 16px;
        }
        .stat strong {
            display: block;
            font-size: 1.5rem;
            margin-bottom: 5px;
            color: #1d4ed8;
        }
        .panel {
            background: linear-gradient(180deg, #ffffff 0%, #edf4ff 100%);
            border-radius: 24px;
            border: 1px solid rgba(37,99,235,0.12);
            padding: 24px;
        }
        .mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 20px;
        }
        .mini-box {
            background: white;
            border: 1px solid rgba(37,99,235,0.12);
            border-radius: 16px;
            padding: 14px 16px;
        }
        .mini-box span {
            display: block;
            color: #475569;
            font-size: 0.78rem;
            margin-bottom: 8px;
        }
        .mini-box strong {
            font-size: 1.2rem;
        }
        .features {
            margin-top: 36px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }
        .feature {
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(37,99,235,0.12);
            border-radius: 20px;
            padding: 22px;
        }
        .feature h3 {
            margin: 14px 0 10px;
        }
        .feature p {
            color: #475569;
            line-height: 1.7;
            margin: 0;
        }
        .icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(37,99,235,0.12), rgba(124,58,237,0.15));
            font-size: 1.4rem;
        }
        @media (max-width: 900px) {
            .hero, .features, .stats {
                grid-template-columns: 1fr;
            }
            nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <div class="brand">CampusMind</div>
            <div class="links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('campusmind.index') }}">Book session</a>
                        <a href="{{ route('forum.index') }}">Forum</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <section class="hero">
            <div>
                <span class="badge">Student wellness platform</span>
                <h1>Care that meets students where they are.</h1>
                <p class="lead">CampusMind helps students access counseling, share support stories, navigate intake, and connect with peers in a safe and welcoming environment.</p>
                <div class="actions">
                    @auth
                        <a class="btn primary" href="{{ route('campusmind.index') }}">Book a counseling session</a>
                        <a class="btn secondary" href="{{ route('stories.index') }}">Read stories</a>
                    @else
                        <a class="btn primary" href="{{ route('login') }}">Get started</a>
                        <a class="btn secondary" href="{{ route('register') }}">Create account</a>
                    @endauth
                </div>
                <div class="stats">
                    <div class="stat"><strong>24/7</strong>Support access</div>
                    <div class="stat"><strong>3</strong>Core pathways</div>
                    <div class="stat"><strong>100%</strong>Student-first care</div>
                </div>
            </div>

            <div class="panel">
                <div class="badge" style="background: rgba(124,58,237,0.08); color: #7c3aed;">Live overview</div>
                <div class="mini-grid">
                    <div class="mini-box"><span>Available today</span><strong>8 slots</strong></div>
                    <div class="mini-box"><span>Pending intake</span><strong>3 cases</strong></div>
                    <div class="mini-box"><span>Community stories</span><strong>12 shared</strong></div>
                    <div class="mini-box"><span>Forum topics</span><strong>25 active</strong></div>
                </div>
            </div>
        </section>

        <section class="features">
            <article class="feature">
                <div class="icon">💬</div>
                <h3>Secure sessions</h3>
                <p>Book counselor appointments and keep support access simple for students.</p>
            </article>
            <article class="feature">
                <div class="icon">🧭</div>
                <h3>Confidential intake</h3>
                <p>Capture concerns through structured intake for timely and appropriate care.</p>
            </article>
            <article class="feature">
                <div class="icon">🤝</div>
                <h3>Peer support</h3>
                <p>Explore stories and participate in a connected, inclusive campus wellbeing community.</p>
            </article>
        </section>
    </div>
</body>
</html>
