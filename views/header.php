<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- automatically handle smaller mobile devices -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/styles/main.css">
</head>

<body>


  <header id="header" class="header d-flex align-items-center fixed-top">



    <div id="header-div" class="container-xl position-relative align-items-center justify-content-between">
      <!-- Logo -->
      <h1 class="logo">
        <span class="logo-line1">Book</span>
        <span class="logo-line2">Reviews</span>
      </h1>

      <!-- Navigation -->
      <nav class="navbar navbar-expand-sm bg-black">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <button class="btn btn-link nav-link dropdown-toggle" id="sortDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Sort by Date of Review
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                  <li><button class="dropdown-item" onclick="location.href='/sort/latest'">Newest First</button></li>
                  <li><button class="dropdown-item" onclick="location.href='/sort/oldest'">Oldest First</button></li>
                </ul>
              </li>
              <li class="nav-item">
                <button class="btn btn-link nav-link" onclick="location.href='/sort/alpha'">Sort alphabetically</button>
              </li>
              <li class="nav-item">
                <button class="btn btn-link nav-link" onclick="toggleNewItemForm()">Add new Review</button>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    </div>
  </header>