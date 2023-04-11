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
      const response = await attendence("POST", userLocation, csrftoken);
      canAttendent = response === 'ok' ? '출석 가능한 위치' : '출석 가능한 위치 아님';
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

  <!-- 기존에 출석 했는지 안했는지 -->
  <h1 class="my_attendence">출석 여부 데이터 : {{ $isAttendent }}<h1>
  <h1 class="my_attendence">강의실 정보 : {{ $classRoomId }}<h1>
  <h1 class="my_attendence">반 정보 : {{ $classId }}<h1>
  
  <!-- 유저 위치에서 접속 가능한지 확인 -->
  <button class="attendent">출석 가능?</button>


</body>

</html>