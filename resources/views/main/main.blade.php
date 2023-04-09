<!-- 출석 안 한 상태의 페이지 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Main 출석 페이지</title>

  <!-- CSRF TOKEN -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <script type="module" defer>
    import {getLocation} from '/js/mainPage/getLocation.js';
    import {attendence} from '/js/mainPage/attendent.js';

    let canAttendent;
    let userLocation;
    const csrftoken = document.head.querySelector("[name=csrf-token][content]").content;
    
    // 처음 접속했을 시
    window.onload = async () => {
      userLocation = await getLocation(); // 자신의 위치 가져오기       
      // 출석 가능 여부 - ODEGO 서버로 요청, csrf 토큰 필요함
      canAttendent = await attendence("POST", userLocation, csrftoken);
      document.querySelector('.attendent').textContent = canAttendent;
    }
        
    // 버튼 누를 시 put requset 후 결과 값 받아오기
    document.querySelector('.attendent').addEventListener('click',
    async (e) => {
        userLocation = await getLocation(); // 자신의 위치 가져오기 
        const myAtt = await attendence("PUT", userLocation, csrftoken);
        e.target.textContent = myAtt;
      });

  </script>
</head>

<body>

  <!-- 출석(1. 기존에 이미 출석, 2. 현재 출석 요청), 출석 가능, 출석 불가능 -->
  <h1 class="my_attendence">{{ $isAttend }}
    <h1>
      <button class="attendent">...</button>


</body>

</html>