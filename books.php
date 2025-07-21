<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Books</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <h1 style="text-align: center">The Book Nook</h1>

    <div class="nav-box">
      <nav>
        <a href="Home.html">Home</a>
        <a href="add_customer.php">Library Card Signup</a>
        <a href="books.php">Books</a>
        <a href="checkout.php">Checkout</a>
        <a href="show_customer.php">Customer Records</a>

      </nav>
    </div>

  
  </header>
 <main>
    <section class="book-collection">
      <!-- Row 1 -->
      <div class="book-row">
        <div class="book-card">
          <img src="fundamentals.jpg" alt="Book 1" />
          <h3>Fundamentals of Software Architecture</h3>
          <button onclick="location.href='fundamentalsBook.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="mythicalMan.jpg" alt="Book 2" />
          <h3>The Mythical Man-Month</h3>
          <button onclick="location.href='mythical.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="philosophy.jpg" alt="Book 3" />
          <h3>Philosophy of Software Design</h3>
          <button onclick="locstion.href='philosophy.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="cyberDummies.jpg" alt="Book 4" />
          <h3>Cybersecurity For Dummies</h3>
          <button onclick="location.href='cyberdummies.html'">More Info</button>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="book-row">
        <div class="book-card">
          <img src="hackingDummies.jpg" alt="Book 5" />
          <h3>Hacking For Dummies</h3>
          <button onclick="location.href='hackingDum.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="Cleancode.jpg" alt="Book 6" />
          <h3>Clean Code</h3>
          <button onclick="location.href='cleanCode.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="pragmaticPro.jpg" alt="Book 7" />
          <h3>The Pragmatic Programmer</h3>
          <button onclick="location.href='pragmaticPro.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="theProb.jpg" alt="Book 8" />
          <h3>The Problem with Software</h3>
          <button onclick="location.href='probSoftware.html'">More Info</button>
        </div>
      </div>
       <!-- Row 3 -->
      <div class="book-row">
        <div class="book-card">
          <img src="designPatt.jpg" alt="Book 9" />
          <h3>Design Patterns</h3>
          <button onclick="location.href='designPatt.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="cyberMaster.jpg" alt="Book 10" />
          <h3>Cybersecurity Career Master Plan</h3>
          <button onclick="location.href='cyberMaster.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="codeCompl.jpg" alt="Book 11" />
          <h3>Code Complete</h3>
          <button onclick="location.href='codeComp.html'">More Info</button>
        </div>
        <div class="book-card">
          <img src="effectiveJ.jpg" alt="Book 12" />
          <h3>Effective Java</h3>
          <button onclick="location.href='effectivej.html'">More Info</button>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
