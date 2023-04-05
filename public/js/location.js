const getLocation = () => {
  // 1. Producer
  // Promise 객체를 생성하면 resolve와 reject를 매개변수로 가지는 excutor 콜백함수를 넣어야 한다. excutor는 바로 실행된다.
  // excutor는 코드가 성공적으로 실행되면 resolve, 실행이 안되면 reject 값을 가진다.
  return new Promise((resolve, reject) => {
    const geoTimeOut = {
      timeout: 10 * 1000,
    };

    // Geolocation API 지원하는 브라우저의 경우
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        // success callback
        (position) => {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;
          resolve({ latitude, longitude });
        },
        // error callback
        (error) => {
          reject(new Error(error));
        },
        // option
        geoTimeOut
      );
    } else {
      reject(new Error('Geolocation API를 지원하지 않는 브라우저입니다.'));
    }
  });
};

export { getLocation }