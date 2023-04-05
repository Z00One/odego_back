<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Main 출석 페이지</title>
  <!-- <?php //echo ("<script> const attendanted = $attendanted </script>"); 
        ?> -->

  <script type="module" defer>
    import {
      getLocation
    } from '/js/location.js';

    let userLocation = await getLocation();

    console.log(userLocation)

    const canAttend = {};

    // 위치 데이터 요청, 응답 데이터 받기
    await fetch("http://localhost:8000", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}", // csrf 토큰 함수 호출
          "Content-Type": "application/json" // MIME
        },
        body: JSON.stringify({
          location: userLocation
        }),
      }).then(response => { return response.ok // HTTP request 
        ? response.json()
        : new Error('response error');})
      .then(data => canAttend.data = data) // response 데이터
      .catch(error => console.error(error)); // fetch 에러

    document.querySelector('.attendent').textContent = canAttend.data;
  </script>
</head>

<body>

  <!-- 출석(1. 기존에 이미 출석, 2. 현재 출석 요청), 출석 가능, 출석 불가능 -->
  <h1 class="attendented">{{ $isAttend }}
    <h1>
      <h1 class="attendent">
        <h1>

</body>

</html>