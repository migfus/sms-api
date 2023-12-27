<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CMU HRMO</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="/images/logo.svg" type="image/x-icon">
	@vite('resources/css/app.css')
</head>

<body class="h-full">
  SMS API v1.0.0
	@vite('resources/js/app.ts')
</body>
</html>
