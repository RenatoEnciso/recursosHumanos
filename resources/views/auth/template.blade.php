<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{URL::asset('images/logo.png')}}">
    <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: [' /assets/css/fonts.min.css']},
            active: function() {sessionStorage.fonts = true;}
        });
    </script>
</head>
<body>
    <div class="container">
        <main>
            @yield('main')
        </main>
        @yield('footer')
    </div>
</body>
<style type="text/css">
    :root {
        --main-color: #255fa4;
        --bg-color: rgba(253,251,255,.8);
        --d1-color: rgba(242,243,250,.8);

        --submain-color: #1a1c1e;
        --in-color: #ffffff;
        --in-border-color: #757578;
        --in-border1-color: #38383b;
        --in-background-color: rgba(244,242,246,.8);
        --in-background1-color: rgba(235,233,237,.8);
        --aa-color: #0f1b32;
        --aa-background-color: rgba(216,226,255,.8)
    }
    @media (prefers-color-scheme: dark) {
        :root {
            --main-color: #a6c8ff;
            --bg-color: rgba(26,28,30,.8);
            --d1-color: rgba(33,37,41,.8);

            --submain-color: #e3e2e6;
            --in-color: #003060;
            --in-border-color: #929396;
            --in-border1-color: #c9c9cc;
            --in-background-color: rgba(34,36,38,.8);
            --in-background1-color: rgba(42,44,46,.8);
            --aa-color: #d9e3f8;
            --aa-background-color: rgba(61,71,88,.8)
        }
    }
    .container {
        background: var(--bg-color);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        backdrop-filter: saturate(180%) blur(20px)
    }
    .bottom {
        display: flex;
        flex-direction: row-reverse;
        width: 100%
    }
    body {
        margin: 0; 
        font-family: sans-serif;
        background: linear-gradient(
            217deg,
            rgba(162,59,53,.84),
            rgba(255, 0, 0, 0) 70.71%
            ), linear-gradient(127deg, rgba(7,100,126,.84), rgba(0, 255, 0, 0) 70.71%),
            linear-gradient(336deg, rgba(167,173,175,.84), rgba(0, 0, 255, 0) 70.71%);
        background-size: cover;
        color: var(--submain-color)
    }
    main {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: center
    }
    form {
        display: flex;
        gap: 24px;
        flex-direction: column;
        align-items: center;
        padding: 24px;
        
    }
    form.register {
        background: var(--d1-color);
        min-width: 40vw;
        border-radius: 12px
    }
    form img {
        width: 96px;
        object-fit: cover
    }
    form i {
        font-size: 36px
    }
    form span {
        font-size: 24px
    }
    input {
        padding: 15px 13px;
        outline: none;
        color: var(--submain-color);
        font-size: 16px;
        box-sizing: border-box;
        width: 100%
    }
    input.primary {
        border: 0;
        border-radius: 50vh;
        background: var(--in-background-color);
        transition: background .25s ease-in-out
    }
    input.secondary {
        border: 1px var(--in-border-color) solid;
        border-radius: 4px;
        background: none
    }
    input.primary:hover {
        background: var(--in-background1-color);
        transition: background .25s ease-in-out
    }
    input.secondary:hover {
        border: 1px var(--in-border1-color) solid
    }
    input:focus {
        caret-color: var(--main-color); 
    }
    input.secondary:focus {
        border: 2px var(--main-color) solid;
        padding: 14px 12px
    }
    input[type=submit] {
        cursor: pointer
    }
    input.hide[type=submit] {
        display: none
    }
    input.primary[type=submit] {
        background: var(--main-color);
        color: var(--in-color);
        height: 40px;
        padding: 0 24px;
        border-radius: 50vh;
        border: 0
    }
    input[type=button] {
        background: transparent;
        color: var(--main-color);
        height: 40px;
        padding: 0 24px;
        border-radius: 50vh;
        border: 1px var(--in-border-color) solid;
        cursor: pointer
    }
    select {
        padding: 15px 13px;
        width: 100%;
        border: 1px var(--in-border-color) solid;
        border-radius: 4px;
        background: none;
        outline: none;
        color: var(--submain-color);
        font-size: 16px
    }
    select:hover {
        border: 1px var(--in-border1-color) solid
    }
    select:focus {
        caret-color: var(--main-color);
        border: 2px var(--main-color) solid;
        padding: 14px 12px
    }
    footer {
        display: flex;
        gap: 16px;
        justify-content: center;
        padding: 24px
    }
    a {
        text-decoration: none;
        display: flex;
        gap: 8px;
        flex-direction: column;
        text-align: center;
        align-items: center;
        color: var(--main-color);
        font-size: 14px;
    }
    a.active {
        color: var(--aa-color)
    }
    a div {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 40px;
        width: 40px
    }
    a div.active {
        border-radius: 20px; 
        background: var(--aa-background-color)
    }
    a i {
        font-size: 18px
    }
</style>
</html>