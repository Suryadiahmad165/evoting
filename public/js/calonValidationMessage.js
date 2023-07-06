let nimketua = document.querySelector("#nimketua")
nimketua.oninvalid = function (e) {
  e.target.setCustomValidity("NIM Calon Ketua Tidak Boleh Kosong")
}

nimketua.oninput = function(e) {
  e.target.setCustomValidity('');
};

let nimwakil = document.querySelector("#nimwakil")

nimwakil.oninvalid = function (e) {
  e.target.setCustomValidity("NIM Calon Wakil Ketua Tidak Boleh Kosong")
}

nimwakil.oninput = function(e) {
  e.target.setCustomValidity("")
}

let namaketua = document.querySelector("#namaketua")

namaketua.oninvalid = function (e) {
  e.target.setCustomValidity("Nama Calon Ketua Tidak Boleh Kosong")
}

namaketua.oninput = function (e) {
  e.target.setCustomValidity("")
}

let namawakil = document.querySelector("#namawakil")

namawakil.oninvalid = function (e) {
  e.target.setCustomValidity("Nama Calon Wakil Ketua Tidak Boleh Kosong")
}

namawakil.oninput = function (e) {
  e.target.setCustomValidity("")
}

let visi = document.querySelector("#visi")

visi.oninvalid = function (e) {
  e.target.setCustomValidity("Visi Calon Tidak Boleh Kosong")
}

visi.oninput = function (e) {
  e.target.setCustomValidity("")
}

let misi = document.querySelector("#misi")

misi.oninvalid = function (e) {
  e.target.setCustomValidity("Misi Calon Tidak Boleh Kosong")
}

misi.oninput = function (e) {
  e.target.setCustomValidity("")
}

let foto = document.querySelector("#foto")

foto.oninvalid = function (e) {
  e.target.setCustomValidity("Foto Paslon Tidak Boleh Kosong")
}

foto.oninput = function (e) {
  e.target.setCustomValidity("")
}