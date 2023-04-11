// 위치 데이터 요청, 응답 데이터 받기
const attendence = (method, userLocation, csrfToken) => {
  return fetch("http://localhost:8000", {
    method: method,

    headers: {
      "X-CSRF-TOKEN": csrfToken, // csrf 토큰 함수 호출 - 419 
      "Content-Type": "application/json" // MIME
    },

    body: JSON.stringify({
      location: userLocation
    })
  }).then(response => {
      return response.ok // HTTP request 
        ? response.json()
        : new Error('response error');
    })
    .then(data => {return data} ) // response 데이터
    .catch(error => {return () => console.error(error)}); // fetch 에러
}

export { attendence }