function validatePenerima() {
    var namaPenerima = document.getElementById('nama').value;
    var noTelpPenerima = document.getElementById('no_tlp').value;
    var alamatPenerima = document.getElementById('alamat').value;
  
    // Jika salah satu kolom data penerima kosong, tampilkan pesan kesalahan
    if (namaPenerima === '' || noTelpPenerima === '' || alamatPenerima === '') {
      alert('Harap lengkapi data penerima sebelum Check Out!');
      return false; // Batalkan 'Check Out'
    }
  
    return true; // Lanjutkan 'Check Out'
  }
  
  document.querySelector('.btn-checkout').addEventListener('click', function(event) {
    var isPenerimaValid = validatePenerima();
  
    if (!isPenerimaValid) {
      event.preventDefault(); // Batalkan tindakan 'Check Out' jika data penerima kosong
    }
  });
  