function validateRegister(event) {
  let username = document.getElementById("username").value;
  let phone = document.getElementById("phone").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;
  let confirm_password = document.getElementById("confirm_password").value;

  var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (!username || !phone || !email || !password || !confirm_password) {
    alert("vui lòng nhập đủ các trường bắt buộc");
    return false;
  } else {
    if (username.length < 5) {
      alert("username lớn hơn 5 kí tự");
      return false;
    }
    if (!email.match(mailFormat)) {
      alert("email không đúng định dạng");
      return false;
    }
    if (password.length < 5) {
      alert("password lớn hơn 5 kí tự");
      return false;
    }
    if (password !== confirm_password) {
      alert("password xác nhận không chính xác");
      return false;
    }
  }
  return true;
}

function validateLogin(event) {
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (!email || !password) {
    alert("vui lòng nhập đủ các trường bắt buộc");
    return false;
  } else {
    if (!email.match(mailFormat)) {
      alert("email không đúng định dạng");
      return false;
    }
    if (password.length < 5) {
      alert("password lớn hơn 5 kí tự");
      return false;
    }
  }
  return true;
}

function validateCart(event) {}
