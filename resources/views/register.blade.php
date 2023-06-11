<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원가입 폼</title>
</head>

<body>
  <h1>회원가입</h1>
  <form action="/register" method="post">
    @csrf
    <div>
      <label for="student_id">학번</label>
      <input type="text" name="student_id" id="student_id" required>
    </div>
    <div>
      <label for="class_id">반 번호</label>
      <input type="text" name="class_id" id="class_id" required>
    </div>
    <div>
      <label for="name">이름</label>
      <input type="text" name="name" id="name" value="{{ session('name') }}" required>
    </div>
    <input type="hidden" name="oauth_id" value="{{ session('oauth_id') }}">
    <div>
      <label for="contact">연락처</label>
      <input type="text" name="contact" id="contact">
    </div>
    <div>
      <label for="student_pw">비밀번호</label>
      <input type="password" name="student_pw" id="student_pw" required>
    </div>
    <button type="submit">회원가입</button>
  </form>
</body>

</html>
