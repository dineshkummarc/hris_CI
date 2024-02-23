function encryptData(data, key) {
    // Bangkitkan kunci enkripsi dari kunci acak dengan PBKDF2
    var salt = CryptoJS.lib.WordArray.random(128 / 8); // Salt acak
    var derivedKey = CryptoJS.PBKDF2(key, salt, {
        keySize: 256 / 32,
        iterations: 1000
    }); // Bangkitkan kunci acak

    // Enkripsi data dengan kunci acak dan vektor inisialisasi acak
    var iv = CryptoJS.lib.WordArray.random(128 / 8); // Vektor inisialisasi acak
    var encrypted = CryptoJS.AES.encrypt(data, derivedKey, {
        iv: iv
    });

    // Gabungkan salt, vektor inisialisasi, dan data terenkripsi menjadi satu string
    var saltHex = CryptoJS.enc.Hex.stringify(salt);
    var ivHex = CryptoJS.enc.Hex.stringify(iv);
    var encryptedHex = CryptoJS.enc.Hex.stringify(encrypted.ciphertext);
    return saltHex + ivHex + encryptedHex;
}