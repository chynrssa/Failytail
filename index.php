<?php
include 'view/layout/header.php';

// 1. Koneksi ke database
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$selected_genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT 
            filmadmin.id, 
            filmadmin.poster, 
            filmadmin.judul, 
            filmadmin.genre, 
            filmadmin.deskripsi,
            AVG(ulasan.rating) as avg_rating
        FROM filmadmin 
        LEFT JOIN ulasan ON filmadmin.id = ulasan.film_id";

$where_clauses = [];
$params = [];
$types = '';

if (!empty($selected_genre) && $selected_genre !== 'Semua') {
    $where_clauses[] = "filmadmin.genre LIKE ?";
    $params[] = "%" . $selected_genre . "%";
    $types .= 's';
}

if (!empty($search_query)) {
    $where_clauses[] = "LOWER(filmadmin.judul) LIKE ?";
    $params[] = "%" . strtolower($search_query) . "%";
    $types .= 's';
}

if (!empty($where_clauses)) {
    $sql .= " WHERE " . implode(" AND ", $where_clauses);
}

$sql .= " GROUP BY filmadmin.id ORDER BY filmadmin.id DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

?>
<section class="bg-white py-1">
  <!-- Gambar dan Teks -->
  <div class="container mx-auto px-4">
    <div class="relative rounded-xl overflow-hidden h-60 md:h-60">
      <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent z-10"></div>
      <img
        src="https://readdy.ai/api/search-image?query=cinematic%20scene%20with%20movie%20theater%20audience%20watching%20an%20exciting%20film%2C%20dramatic%20lighting%2C%20immersive%20experience%2C%20people%20sharing%20emotions%2C%20high%20quality%20professional%20photography&width=1280&height=500&seq=1&orientation=landscape"
        alt="Film Experience"
        class="w-full h-full object-cover"
      />
      <div class="absolute top-0 left-0 w-full h-full flex items-center z-20">
        <div class="text-white px-8 md:px-16 max-w-2xl">
          <h1 class="text-3xl md:text-4xl font-bold mb-4">
            Temukan Film Favoritmu
          </h1>
          <p class="text-lg mb-6">
            Baca ulasan dari penonton lain dan bagikan pengalamanmu sendiri setelah menonton film.
          </p>
          <div class="flex flex-wrap gap-3">
            <button class="bg-primary text-white px-6 py-3 rounded-button font-medium whitespace-nowrap hover:bg-opacity-90 transition">
              Jelajahi Film
            </button>
            <button class="bg-white text-gray-800 px-6 py-3 rounded-button font-medium whitespace-nowrap hover:bg-gray-100 transition">
              Tulis Ulasan
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Film Categories -->
     <section class="py-8 bg-gray-50">
       <div class="container mx-auto px-4 mb-6">
      <form action="index.php#film-categories" method="GET" class="relative w-full max-w-[50%] mx-auto">
        <input type="text" name="search" placeholder="Cari film berdasarkan judul..." value="<?= htmlspecialchars($search_query) ?>" class="w-full py-2 px-4 pr-10 text-sm rounded-full border border-gray-300 text-gray-800 shadow-md focus:outline-none focus:ring-2 focus:ring-primary"/>
        <?php if (!empty($selected_genre)): ?>
            <input type="hidden" name="genre" value="<?= htmlspecialchars($selected_genre) ?>">
        <?php endif; ?>
        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary">
          <i class="ri-search-line text-base"></i>
        </button>
      </form>
  </div>
      
      <div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Kategori Film</h2>
      <a href="index.php#film-categories" class="text-primary font-medium text-sm flex items-center">Lihat Semua<i class="ri-arrow-right-line ml-1"></i></a>
    </div>
    
    <div class="flex overflow-x-auto whitespace-nowrap mb-6 pb-2">
      <?php
        $categories = ['Semua', 'Action', 'Drama', 'Comedy', 'Horror', 'Sci-Fi', 'Romance', 'Thriller'];
        foreach ($categories as $category) {
            $is_active = (empty($selected_genre) && $category === 'Semua') || ($selected_genre === $category);
            $active_class = $is_active ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-100';
            $url_genre = ($category === 'Semua') ? '' : $category;
            echo "<a href='index.php?genre=$url_genre#film-categories' class='$active_class px-5 py-2 rounded-full text-sm mr-3 whitespace-nowrap transition-colors duration-300'>$category</a>";
        }
      ?>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
      <?php
      if ($result->num_rows > 0) {
        while ($film = $result->fetch_assoc()) {
          $posterPath = str_replace('../', '', $film['poster']);
      ?>
      <a href="pengguna/film/detail-film.php?id=<?= $film['id'] ?>" class="block film-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
        <div class="relative">
            <img src="<?= htmlspecialchars($posterPath) ?>" alt="<?= htmlspecialchars($film['judul']) ?>" class="w-full h-60 object-cover" />
          <div class="absolute top-2 right-2 bg-primary text-white text-xs px-2 py-1 rounded-full flex items-center gap-1">
            <i class="ri-star-fill"></i>
            <span>
              <?= !empty($film['avg_rating']) ? number_format($film['avg_rating'], 1) : 'N/A' ?>
            </span>
          </div>
        </div>
        <div class="p-3">
          <h3 class="font-semibold text-gray-800 mb-1 truncate"><?= htmlspecialchars($film['judul']) ?></h3>
          <p class="text-xs text-gray-500 truncate"><?= htmlspecialchars($film['deskripsi']) ?></p>
        </div>
      </a>
      <?php
        }
      } else {
        echo "<p class='col-span-full text-center text-gray-500'>Tidak ada film yang cocok dengan kriteria Anda.</p>";
      }
      $stmt->close();
      $conn->close();
      ?>
    </div>
  </div>
          
    </section>
    <!-- Popular Reviews -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Ulasan Terpopuler</h2>
          <a
            href="/FAILYTAIL/pengguna/ulasan/ulasan.php"
            class="text-primary font-medium text-sm flex items-center"
          >
            Lihat Semua
            <i class="ri-arrow-right-line ml-1"></i>
          </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Review 1 -->
          <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
            <div class="flex items-center mb-4">
              <div
                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
              >
                <i class="ri-user-3-line text-gray-500"></i>
              </div>
              <div>
                <h4 class="font-medium text-gray-800">Budi Santoso</h4>
                <p class="text-xs text-gray-500">16 Juni 2025</p>
              </div>
            </div>
            <div class="flex items-center mb-3">
              <h3 class="font-semibold text-gray-800 mr-3">Inception</h3>
              <div class="flex items-center text-yellow-500 text-xs">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
              </div>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              Film ini benar-benar mengagumkan! Konsep mimpi dalam mimpi sangat
              brilian dan membuat saya berpikir selama berhari-hari. Christopher
              Nolan memang jenius dalam menciptakan cerita yang kompleks namun
              tetap bisa diikuti...
            </p>
            <div class="flex justify-between items-center">
              <a href="#" class="text-primary text-sm font-medium"
                >Baca Selengkapnya</a
              >
              <div class="flex items-center space-x-4 text-gray-500 text-sm">
                <div class="flex items-center">
                  <i class="ri-thumb-up-line mr-1"></i>
                  <span>128</span>
                </div>
                <div class="flex items-center">
                  <i class="ri-chat-1-line mr-1"></i>
                  <span>24</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Review 2 -->
          <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
            <div class="flex items-center mb-4">
              <div
                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
              >
                <i class="ri-user-3-line text-gray-500"></i>
              </div>
              <div>
                <h4 class="font-medium text-gray-800">Dewi Lestari</h4>
                <p class="text-xs text-gray-500">14 Juni 2025</p>
              </div>
            </div>
            <div class="flex items-center mb-3">
              <h3 class="font-semibold text-gray-800 mr-3">Oppenheimer</h3>
              <div class="flex items-center text-yellow-500 text-xs">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-half-fill"></i>
              </div>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              Akting Cillian Murphy luar biasa menghidupkan karakter
              Oppenheimer. Film ini tidak hanya bercerita tentang pembuatan bom
              atom, tetapi juga menggali sisi moral dan etika dari penemuan yang
              mengubah dunia. Cinematografinya juga sangat memukau...
            </p>
            <div class="flex justify-between items-center">
              <a href="#" class="text-primary text-sm font-medium"
                >Baca Selengkapnya</a
              >
              <div class="flex items-center space-x-4 text-gray-500 text-sm">
                <div class="flex items-center">
                  <i class="ri-thumb-up-line mr-1"></i>
                  <span>95</span>
                </div>
                <div class="flex items-center">
                  <i class="ri-chat-1-line mr-1"></i>
                  <span>18</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Review 3 -->
          <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
            <div class="flex items-center mb-4">
              <div
                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
              >
                <i class="ri-user-3-line text-gray-500"></i>
              </div>
              <div>
                <h4 class="font-medium text-gray-800">Andi Pratama</h4>
                <p class="text-xs text-gray-500">15 Juni 2025</p>
              </div>
            </div>
            <div class="flex items-center mb-3">
              <h3 class="font-semibold text-gray-800 mr-3">The Martian</h3>
              <div class="flex items-center text-yellow-500 text-xs">
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-fill"></i>
                <i class="ri-star-line"></i>
              </div>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              Saya sangat menikmati bagaimana film ini menggabungkan sains yang
              akurat dengan humor. Matt Damon berhasil membuat karakter Mark
              Watney menjadi sangat menghibur meskipun dalam situasi hidup dan
              mati. Pemandangan Mars juga sangat menakjubkan...
            </p>
            <div class="flex justify-between items-center">
              <a href="#" class="text-primary text-sm font-medium"
                >Baca Selengkapnya</a
              >
              <div class="flex items-center space-x-4 text-gray-500 text-sm">
                <div class="flex items-center">
                  <i class="ri-thumb-up-line mr-1"></i>
                  <span>76</span>
                </div>
                <div class="flex items-center">
                  <i class="ri-chat-1-line mr-1"></i>
                  <span>12</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Film Detail Section -->
    <section class="py-8 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Film</h2>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
          <div class="flex flex-col md:flex-row">
            <!-- Film Info -->
            <div class="md:w-1/3 p-6">
              <div class="relative mb-4">
                <img
                  src="https://readdy.ai/api/search-image?query=cinematic%20movie%20poster%20for%20inception%2C%20dream%20within%20dreams%20concept%2C%20professional%20movie%20poster%20style%2C%20dark%20blue%20tones%2C%20high%20quality&width=400&height=600&seq=7&orientation=portrait"
                  alt="Inception"
                  class="w-full h-auto rounded-lg"
                />
                <div
                  class="absolute top-3 right-3 bg-primary text-white text-sm px-2 py-1 rounded-full"
                >
                  9.2
                </div>
              </div>
              <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Inception (2010)
              </h1>
              <div class="flex items-center mb-4">
                <div class="flex items-center text-yellow-500 mr-2">
                  <i class="ri-star-fill"></i>
                  <i class="ri-star-fill"></i>
                  <i class="ri-star-fill"></i>
                  <i class="ri-star-fill"></i>
                  <i class="ri-star-half-fill"></i>
                </div>
                <span class="text-gray-600 text-sm">9.2/10 (1,283 ulasan)</span>
              </div>
              <div class="mb-4">
                <div class="flex flex-wrap gap-2">
                  <span
                    class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full"
                    >Sci-Fi</span
                  >
                  <span
                    class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full"
                    >Action</span
                  >
                  <span
                    class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full"
                    >Thriller</span
                  >
                </div>
              </div>
              <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                  Sutradara
                </h3>
                <p class="text-sm text-gray-600">Christopher Nolan</p>
              </div>
              <div class="mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                  Pemeran
                </h3>
                <p class="text-sm text-gray-600">
                  Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page, Tom
                  Hardy, Ken Watanabe
                </p>
              </div>
              <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-2">
                  Sinopsis
                </h3>
                <p class="text-sm text-gray-600">
                  Dom Cobb adalah pencuri ulung yang mencuri rahasia berharga
                  dari dalam alam bawah sadar saat pikiran target sedang berada
                  dalam keadaan mimpi. Kemampuan langka Cobb telah menjadikannya
                  pemain berharga dalam dunia spionase korporat yang berbahaya,
                  tetapi juga membuatnya menjadi buronan internasional dan
                  memaksanya untuk meninggalkan kehidupan yang pernah ia kenal.
                </p>
              </div>
            </div>
            <!-- Reviews Section -->
            <div
              class="md:w-2/3 border-t md:border-t-0 md:border-l border-gray-200"
            >
              <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                  <h2 class="text-xl font-bold text-gray-800">
                    Ulasan Penonton
                  </h2>
                 
                </div>
                <!-- Write Review -->
                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                  <h3 class="text-sm font-semibold text-gray-700 mb-3">
                    Tulis Ulasan Anda
                  </h3>
                  <div class="flex items-center mb-3">
                    <p class="text-sm text-gray-600 mr-3">Rating:</p>
                    <div class="star-rating flex text-gray-400">
                      <input type="radio" id="star5" name="rating" value="5" />
                      <label for="star5"><i class="ri-star-fill"></i></label>
                      <input type="radio" id="star4" name="rating" value="4" />
                      <label for="star4"><i class="ri-star-fill"></i></label>
                      <input type="radio" id="star3" name="rating" value="3" />
                      <label for="star3"><i class="ri-star-fill"></i></label>
                      <input type="radio" id="star2" name="rating" value="2" />
                      <label for="star2"><i class="ri-star-fill"></i></label>
                      <input type="radio" id="star1" name="rating" value="1" />
                      <label for="star1"><i class="ri-star-fill"></i></label>
                    </div>
                  </div>
                  <textarea
                    placeholder="Bagikan pendapat Anda tentang film ini..."
                    class="w-full p-3 border border-gray-200 rounded-lg text-sm mb-3 focus:outline-none focus:border-primary"
                    rows="3"
                  ></textarea>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      
                    </div>
                    <button
                      class="bg-primary text-white px-4 py-2 rounded-button text-sm font-medium whitespace-nowrap hover:bg-opacity-90 transition"
                    >
                      Kirim Ulasan
                    </button>
                  </div>
                </div>
                <!-- Review List -->
                <div class="space-y-5">
                  <!-- Review 1 -->
                  <div class="border-b border-gray-100 pb-5">
                    <div class="flex items-center mb-3">
                      <div
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
                      >
                        <i class="ri-user-3-line text-gray-500"></i>
                      </div>
                      <div>
                        <h4 class="font-medium text-gray-800">Budi Santoso</h4>
                        <div class="flex items-center">
                          <div
                            class="flex items-center text-yellow-500 text-xs mr-2"
                          >
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                          </div>
                          <p class="text-xs text-gray-500">16 Juni 2025</p>
                        </div>
                      </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">
                      Film ini benar-benar mengagumkan! Konsep mimpi dalam mimpi
                      sangat brilian dan membuat saya berpikir selama
                      berhari-hari. Christopher Nolan memang jenius dalam
                      menciptakan cerita yang kompleks namun tetap bisa diikuti.
                      Akting dari seluruh pemeran juga sangat meyakinkan,
                      terutama Leonardo DiCaprio yang berhasil menampilkan emosi
                      yang mendalam. Visual efeknya juga luar biasa untuk film
                      yang dirilis tahun 2010. Sangat direkomendasikan!
                    </p>
                    <div
                      class="flex items-center space-x-4 text-gray-500 text-sm"
                    >
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-thumb-up-line mr-1"></i>
                        <span>128</span>
                      </button>
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-chat-1-line mr-1"></i>
                        <span>24</span>
                      </button>
                      
                    </div>
                  </div>
                  <!-- Review 2 -->
                  <div class="border-b border-gray-100 pb-5">
                    <div class="flex items-center mb-3">
                      <div
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
                      >
                        <i class="ri-user-3-line text-gray-500"></i>
                      </div>
                      <div>
                        <h4 class="font-medium text-gray-800">Siti Rahayu</h4>
                        <div class="flex items-center">
                          <div
                            class="flex items-center text-yellow-500 text-xs mr-2"
                          >
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-line"></i>
                          </div>
                          <p class="text-xs text-gray-500">14 Juni 2025</p>
                        </div>
                      </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">
                      Saya suka film ini, tapi harus mengakui bahwa alurnya
                      kadang terlalu rumit untuk diikuti. Perlu menonton
                      beberapa kali untuk benar-benar memahami semua lapisan
                      ceritanya. Musik Hans Zimmer sangat memukau dan menambah
                      ketegangan di setiap adegan. Ending-nya juga sangat
                      menarik dan membuat penasaran, meskipun sedikit ambigu.
                      Secara keseluruhan, ini adalah film yang sangat bagus
                      dengan konsep yang orisinal.
                    </p>
                    <div
                      class="flex items-center space-x-4 text-gray-500 text-sm"
                    >
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-thumb-up-line mr-1"></i>
                        <span>87</span>
                      </button>
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-chat-1-line mr-1"></i>
                        <span>15</span>
                      </button>
                      
                    </div>
                  </div>
                  <!-- Review 3 -->
                  <div>
                    <div class="flex items-center mb-3">
                      <div
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3"
                      >
                        <i class="ri-user-3-line text-gray-500"></i>
                      </div>
                      <div>
                        <h4 class="font-medium text-gray-800">Agus Wijaya</h4>
                        <div class="flex items-center">
                          <div
                            class="flex items-center text-yellow-500 text-xs mr-2"
                          >
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-half-fill"></i>
                          </div>
                          <p class="text-xs text-gray-500">12 Juni 2025</p>
                        </div>
                      </div>
                    </div>
                    <div
                      class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-3"
                    >
                      <div
                        class="flex items-center text-yellow-600 text-xs mb-1"
                      >
                        <i class="ri-alert-line mr-1"></i>
                        <span>Peringatan: Ulasan ini mengandung spoiler</span>
                      </div>
                      <p class="text-gray-600 text-sm">
                        Saya sangat terkesan dengan bagaimana Nolan
                        menggambarkan hubungan emosional antara Cobb dan
                        istrinya, Mal. Twist di akhir film ketika kita
                        mengetahui bahwa Mal sebenarnya sudah meninggal dan
                        hanya ada dalam pikiran Cobb sangat mengharukan. Adegan
                        terakhir dengan gasing yang berputar juga sangat ikonik,
                        membuat kita bertanya-tanya apakah Cobb masih berada
                        dalam mimpi atau sudah kembali ke realitas. Menurut
                        saya, ini adalah salah satu film terbaik dalam dekade
                        terakhir.
                      </p>
                    </div>
                    <div
                      class="flex items-center space-x-4 text-gray-500 text-sm"
                    >
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-thumb-up-line mr-1"></i>
                        <span>65</span>
                      </button>
                      <button class="flex items-center hover:text-primary">
                        <i class="ri-chat-1-line mr-1"></i>
                        <span>9</span>
                      </button>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- footer -->
<?php include 'view/layout/footer.php'; ?>


    <script id="starRatingScript">
      document.addEventListener("DOMContentLoaded", function () {
        const starLabels = document.querySelectorAll(".star-rating label");
        starLabels.forEach((label) => {
          label.addEventListener("click", function () {
            const input = document.querySelector(`#${this.getAttribute("for")}`);
            if (input) {
              input.checked = true;
            }
          });
        });
      });
    </script>
    
    <script id="carouselScript">
      document.addEventListener("DOMContentLoaded", function () {
        const indicators = document.querySelectorAll(".absolute.bottom-4 button");
        indicators.forEach((indicator, index) => {
          indicator.addEventListener("click", function () {
            // Reset all indicators
            indicators.forEach((ind) => {
              ind.classList.remove("bg-white");
              ind.classList.add("bg-opacity-50");
            });
            // Highlight current indicator
            this.classList.remove("bg-opacity-50");
            this.classList.add("bg-white");
            // Here you would add logic to change the carousel slide
          });
        });
      });
    </script>
    <script id="filterTabsScript">
      document.addEventListener("DOMContentLoaded", function () {
        const categoryTabs = document.querySelectorAll(
          ".flex.overflow-x-auto.whitespace-nowrap.mb-6 button",
        );
        categoryTabs.forEach((tab) => {
          tab.addEventListener("click", function () {
            // Reset all tabs
            categoryTabs.forEach((t) => {
              t.classList.remove("bg-primary", "text-white");
              t.classList.add("bg-white", "text-gray-700");
            });
            // Highlight current tab
            this.classList.remove("bg-white", "text-gray-700");
            this.classList.add("bg-primary", "text-white");
            // Here you would add logic to filter the content
          });
        });
      });
    </script>
  </body>
</html>
