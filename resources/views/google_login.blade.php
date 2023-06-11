<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Login Example</title>
    <!-- 필요한 경우 스타일 및 스크립트 추가 -->
</head>
<body>
    <div>
        <h1>Google Login Example</h1>
        <button id="googleSignInButton">Sign in with Google</button>
    </div>

    <script>
      // function handleGoogleSignIn() {
      //   // 다음과 같이 Google 로그인 버튼 클릭 시 redirectToGoogle 주소로 Redirect 되도록 설정하세요.
      //   window.location.href = '/auth/google/redirect';
      // }

      // document.getElementById('googleSignInButton').addEventListener(' 생성해야 합니다. 예를 들어,` 파일에 라우트를 추가해야 합니다.
      function handleGoogleSignIn() {
    fetch('/auth/google/redirect')
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('HTTP error: ' + response.status);
            }
        })
        .then(data => {
            console.log(data); // 콘솔에 출력
            if (data.redirect_url) {
                window.location.href = data.redirect_url;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.getElementById('googleSignInButton').addEventListener('click', handleGoogleSignIn);


```php
Route::get('/google-login', [App\Http\Controllers\HomeController::class, 'showGoogleLogin']);
