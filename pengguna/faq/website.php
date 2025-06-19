<?php include('../../view/layout/header.php'); ?>

<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #fefefe;
  }

  .right-section {
  max-width: 900px;
  width: 100%;
  margin: 5px auto 100px auto; /* ↑↑ tambahkan jarak bawah (bottom margin) */
  padding: 0 20px;
}


  .right-section h2 {
    font-size: 28px;
    margin-bottom: 30px;
    font-weight: bold;
    text-align: center;
  }

  .faq-box {
    background: linear-gradient(145deg, #03AFC8, #57DAF0);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    margin-bottom: 50px;
  }

  .faq-item {
    margin-bottom: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .faq-item summary {
    padding: 15px 20px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    list-style: none;
    background-color: #fff;
    border-bottom: 1px solid #eee;
    text-align: left;
    position: relative;
  }

  .faq-item summary::after {
    content: "▼";
    position: absolute;
    right: 20px;
    font-size: 14px;
    transform: rotate(0deg);
    transition: transform 0.3s ease;
  }

  .faq-item[open] summary::after {
    transform: rotate(180deg);
  }

  .faq-answer {
    padding: 15px 20px;
    font-size: 14px;
    background-color: #f9f9f9;
    text-align: left;
    animation: fadeIn 0.3s ease-in-out;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-5px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .right-section h3 {
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
  }

  .topics {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
    margin-top: 20px;
  }

  .topic-container {
    width: 170px;
    text-align: center;
  }

  .topic {
    background: #e6f7fa;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .topic:hover {
    transform: scale(1.05);
  }

  .topic-label {
    margin-top: 10px;
    font-weight: 600;
    font-size: 14px;
  }

  .topic img {
    display: block;
    margin: 0 auto;
  }
</style>

<div class="right-section">
  <h2>Website</h2>

  <div class="faq-box">
    <details class="faq-item">
      <summary><span class="faq-question">Apa itu Failytail?</span></summary>
      <div class="faq-answer">
        <p>Failytail adalah platform komunitas tempat pengguna dapat berbagi pengalaman dan ulasan pribadi setelah menonton film. Kami menyediakan ruang untuk mengekspresikan perasaan, kesan, dan pandangan tentang film secara jujur dan personal.</p>
      </div>
    </details>

    <details class="faq-item">
      <summary><span class="faq-question">Apakah Failytail gratis?</span></summary>
      <div class="faq-answer">
          <p>Ya, Failytail sepenuhnya gratis untuk digunakan. Anda dapat membaca ulasan, menulis pengalaman menonton film, dan berinteraksi dengan pengguna lain tanpa biaya.</p>
      </div>
    </details>

    <details class="faq-item">
      <summary><span class="faq-question">Bagaimana cara menggunakan Failytail?</span></summary>
      <div class="faq-answer">
                        <p>Untuk mulai menggunakan Failytail:</p>
                        <ol>
                            <li>Daftar akun gratis</li>
                            <li>Jelajahi film berdasarkan kategori atau pencarian</li>
                            <li>Baca ulasan dari penonton lain</li>
                            <li>Bagikan pengalaman Anda setelah menonton film</li>
                            <li>Berikan rating dan komentar pada ulasan pengguna lain</li>
                        </ol>
                    </div>
    </details>

    <details class="faq-item">
      <summary><span class="faq-question">Bagaimana cara menghubungi tim dukungan?</span></summary>
      <div class="faq-answer">
                        <p>Anda dapat menghubungi tim dukungan kami melalui email di support@failytail.com atau melalui formulir kontak di bagian bawah halaman ini. Kami biasanya merespons dalam 1-2 hari kerja.</p>
                    </div>
    </details>
  </div>

  <h3>Pilih topik sesuai pertanyaan anda</h3>

  <div class="topics">
    <div class="topic-container">
      <a href="website.php">
        <div class="topic">
          <img src="../../image/logo_failytail.png" alt="Website" style="width: 50%;" />
        </div>
        <div class="topic-label">Website</div>
      </a>
    </div>
    <div class="topic-container">
      <a href="Akun_dan_Pengguna.php">
        <div class="topic">
          <img src="../../image/akun_pengguna.png" alt="Akun dan Pengguna" style="width: 50%;" />
        </div>
        <div class="topic-label">Akun dan Pengguna</div>
      </a>
    </div>
    <div class="topic-container">
      <a href="Ulasan_dan_Rating.php">
        <div class="topic">
          <img src="../../image/Ulasan_dan_Rating.png" alt="Ulasan & Rating" style="width: 50%;" />
        </div>
        <div class="topic-label">Ulasan & Rating Film</div>
      </a>
    </div>
    <div class="topic-container">
      <a href="Fitur_dan_Rekomendasi.php">
        <div class="topic">
          <img src="../../image/Fitur_Rekomendasi.png" alt="Fitur & Rekomendasi" style="width: 65%;" />
        </div>
        <div class="topic-label">Fitur & Rekomendasi</div>
      </a>
    </div>
  </div>
</div>

<?php include('../../view/layout/footer.php'); ?>
