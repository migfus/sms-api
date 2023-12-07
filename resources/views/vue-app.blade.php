<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CMU HRMO</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="/images/logo.svg" type="image/x-icon">

  <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
  <link rel="stylesheet" href="/assets/flash.css" >
  <style>
    .preload-logo-container {
      text-align: center;
      flex-direction: column;
      display: flex;
      justify-content: center;
      align-items: center;
      justify-content: space-between;
      margin: auto;
    }
    .preload-logo-item {
      position: absolute;
      top: 20%;

    }

    .body-loader {
      left: 100px;
      bottom: 0px !important;
      width: 48px;
      height: 48px;
      border: 5px solid #FFF;
      border-bottom-color: #14b8a6;
      border-radius: 50%;
      display: inline-block;
      box-sizing: border-box;
      animation: body-rotation 1s linear infinite;
      position: absolute;
    }

    @keyframes body-rotation {
      0% {
          transform: rotate(0deg);
      }
      100% {
          transform: rotate(360deg);
      }
    }

  </style>
	@vite('resources/css/app.css')
</head>

<body class="h-full">
	<div id="app">

    <div id="loading-bg" class="preload-logo-container">
      <div class="preload-logo-item">
        <div class="loading-bg">
          <object data="/images/logo-anim.svg" style="width: 240px; height: 240px;"/>
        </div>
        {{-- <div class="loading-bg" style="margin-top: 0px">
          <h3>Development {{ env('VITE_VER') }}</h3>
        </div> --}}
      </div>
    </div>

    <h1>{{ $fact }}</h1>




  </div>

	@vite('resources/js/app.ts')
</body>
</html>
