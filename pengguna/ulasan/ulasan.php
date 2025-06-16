<?php include '../../view/layout/header.php'; ?>
  <body class="bg-gray-50 text-gray-800 min-h-screen">
    <div class="container mx-auto max-w-7xl py-3 px-2 flex-grow">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Ulasan Terpopuler</h1>

      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Ulasan 1 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Budi Santoso</h3>
              <p class="text-xs text-gray-500">16 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20inception%2C%20dark%20blue%20tones%2C%20professional%20movie%20poster%20design%2C%20featuring%20Leonardo%20DiCaprio%2C%20minimalist%20style&width=200&height=300&seq=1&orientation=portrait"
                alt="Inception Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">Inception (2010)</h2>
              <p class="text-sm text-gray-600 mb-2">
                Director: Christopher Nolan
              </p>
              <p class="text-xs text-gray-500 mb-2">
                Sci-Fi, Action, Adventure
              </p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Film ini benar-benar mengagumkan! Konsep mimpi dalam mimpi sangat
            brilian dan membuat saya berpikir selama berhari-hari. Christopher
            Nolan memang jenius dalam menciptakan cerita yang kompleks namun
            tetap bisa diikuti.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">125</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-1"></i>
                <span class="text-xs">24</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan 2 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Dewi Lestari</h3>
              <p class="text-xs text-gray-500">18 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20oppenheimer%2C%20dramatic%20dark%20tones%2C%20professional%20movie%20poster%20design%2C%20featuring%20Cillian%20Murphy%2C%20atomic%20explosion%20background&width=200&height=300&seq=2&orientation=portrait"
                alt="Oppenheimer Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">Oppenheimer (2023)</h2>
              <p class="text-sm text-gray-600 mb-2">
                Director: Christopher Nolan
              </p>
              <p class="text-xs text-gray-500 mb-2">
                Biography, Drama, History
              </p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-half-fill"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Akting Cillian Murphy luar biasa menghidupkan karakter Oppenheimer.
            Film ini tidak hanya bercerita tentang pembuatan bom atom, tetapi
            juga mengupas sisi moral dan etika dan penemuan yang mengubah dunia.
            Sinematografinya juga sangat memukau.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">95</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-1"></i>
                <span class="text-xs">18</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan 3 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Andi Pratama</h3>
              <p class="text-xs text-gray-500">15 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20the%20martian%2C%20red%20mars%20landscape%2C%20professional%20movie%20poster%20design%2C%20featuring%20Matt%20Damon%20in%20spacesuit&width=200&height=300&seq=3&orientation=portrait"
                alt="The Martian Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">The Martian (2015)</h2>
              <p class="text-sm text-gray-600 mb-2">Director: Ridley Scott</p>
              <p class="text-xs text-gray-500 mb-2">Sci-Fi, Adventure, Drama</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-line"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Saya sangat menikmati bagaimana film ini menggabungkan sains yang
            akurat dengan humor. Matt Damon berhasil membuat karakter Mark
            Watney menjadi sangat menghibur meskipun dalam situasi hidup dan
            mati. Pemandangan Mars juga sangat menakjubkan.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">78</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-1"></i>
                <span class="text-xs">12</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan 4 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Putri Rahayu</h3>
              <p class="text-xs text-gray-500">20 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20parasite%2C%20dark%20mysterious%20tone%2C%20professional%20movie%20poster%20design%2C%20Korean%20style%2C%20featuring%20modern%20house&width=200&height=300&seq=4&orientation=portrait"
                alt="Parasite Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">Parasite (2019)</h2>
              <p class="text-sm text-gray-600 mb-2">Director: Bong Joon-ho</p>
              <p class="text-xs text-gray-500 mb-2">Drama, Thriller</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Film ini menghadirkan kritik sosial yang sangat cerdas tentang
            kesenjangan kelas. Bong Joon-ho berhasil menggabungkan genre komedi,
            thriller, dan drama dengan sangat mulus. Setiap adegan dipikirkan
            dengan matang dan penuh makna tersembunyi.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">156</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-1"></i>
                <span class="text-xs">32</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan 5 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Rudi Hermawan</h3>
              <p class="text-xs text-gray-500">12 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20interstellar%2C%20space%20theme%2C%20professional%20movie%20poster%20design%2C%20featuring%20Matthew%20McConaughey%2C%20cosmic%20background&width=200&height=300&seq=5&orientation=portrait"
                alt="Interstellar Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">Interstellar (2014)</h2>
              <p class="text-sm text-gray-600 mb-2">
                Director: Christopher Nolan
              </p>
              <p class="text-xs text-gray-500 mb-2">Sci-Fi, Adventure, Drama</p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-half-fill"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Perpaduan antara sains yang akurat dan kisah emosional tentang
            hubungan ayah-anak membuat film ini istimewa. Visual efeknya luar
            biasa, terutama adegan black hole yang dibuat berdasarkan
            perhitungan fisika yang sebenarnya. Soundtrack Hans Zimmer juga
            menambah intensitas film.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">142</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-1"></i>
                <span class="text-xs">28</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Ulasan 6 -->
        <div
          class="bg-white rounded shadow-sm hover:shadow-md transition-shadow p-5"
        >
          <div class="flex items-center mb-4">
            <div
              class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden"
            >
              <i class="ri-user-line text-gray-500 ri-lg"></i>
            </div>
            <div class="ml-3">
              <h3 class="font-medium">Siti Nurhaliza</h3>
              <p class="text-xs text-gray-500">19 Juni 2023</p>
            </div>
          </div>
          <div class="flex gap-4 mb-4">
            <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
              <img
                src="https://readdy.ai/api/search-image?query=movie%20poster%20everything%20everywhere%20all%20at%20once%2C%20colorful%20chaotic%20design%2C%20professional%20movie%20poster%20design%2C%20featuring%20Michelle%20Yeoh%2C%20multiverse%20theme&width=200&height=300&seq=6&orientation=portrait"
                alt="Everything Everywhere All at Once Movie Poster"
                class="w-full h-full object-cover"
              />
            </div>
            <div>
              <h2 class="font-bold mb-2">
                Everything Everywhere All at Once (2022)
              </h2>
              <p class="text-sm text-gray-600 mb-2">
                Directors: Daniel Kwan, Daniel Scheinert
              </p>
              <p class="text-xs text-gray-500 mb-2">
                Action, Adventure, Comedy
              </p>
            </div>
          </div>
          <div class="flex text-yellow-400 mb-3">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>
          <p class="text-sm text-gray-700 mb-4 line-clamp-4">
            Film yang sangat inovatif dan emosional. Michelle Yeoh luar biasa
            dalam perannya. Konsep multiverse digunakan dengan cara yang kreatif
            untuk menyampaikan pesan tentang keluarga dan penerimaan diri.
            Visual yang unik dan penuh warna membuat film ini menjadi pengalaman
            yang tidak terlupakan.
          </p>
          <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-primary text-sm hover:underline"
              >Baca Selengkapnya</a
            >
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-gray-500">
                <i class="ri-heart-line mr-1"></i>
                <span class="text-xs">185</span>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-chat-1-line mr-6"></i>
                <span class="text-xs">37</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script id="likeInteraction">
      document.addEventListener("DOMContentLoaded", function () {
        const likeButtons = document.querySelectorAll(".ri-heart-line");
        likeButtons.forEach((button) => {
          button.addEventListener("click", function (e) {
            e.preventDefault();
            const countElement = this.nextElementSibling;
            let count = parseInt(countElement.textContent);
            if (this.classList.contains("ri-heart-fill")) {
              this.classList.replace("ri-heart-fill", "ri-heart-line");
              this.classList.remove("text-red-500");
              countElement.textContent = count - 1;
            } else {
              this.classList.replace("ri-heart-line", "ri-heart-fill");
              this.classList.add("text-red-500");
              countElement.textContent = count + 1;
            }
          });
        });
      });
    </script>
  </body>
</html>
<?php include '../../view/layout/footer.php'; ?>