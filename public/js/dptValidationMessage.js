let nimdpt = document.querySelector("#nimdpt")

nimdpt.oninvalid = function (e) {
  e.target.setCustomValidity("NIM Tidak Boleh Kosong")
}

nimdpt.oninput = function (e) {
  e.target.setCustomValidity("")
}

let namadpt = document.querySelector("#namadpt")

namadpt.oninvalid = function (e) {
  e.target.setCustomValidity("Nama Tidak Boleh Kosong")
}

namadpt.oninput  = function (e) {
  e.target.setCustomValidity("")
}