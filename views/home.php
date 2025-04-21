<?php include 'header.php'; ?>

<div class="custom-container">

  <div id="new-item-form" class="item">
    <!-- Linkes Div: Platzhalter für das Buchcover -->
    <div class="custom-col custom-col-5 text-alignment">
      <p class="text-muted">Add a new book review</p>
      <div class="mb-2">
        <img id="bookCoverPreview" src="" alt="Book Cover Preview" style="max-height: 200px; display: none;">
      </div>
    </div>
    <!-- Rechtes Div: Formular für die Eingabe -->
    <div class="custom-col custom-col-7">
      <form action="/add" method="post" class="w-100">
        <div class="input-group mb-2">
          <input type="text" id="titleNew" name="titleNew" placeholder="Book Title" class="form-control" required>
          <button type="button" class="btn btn-secondary" onclick="searchBook()">Search online</button>
        </div>
        <input type="text" name="authorNew" placeholder="Author Name" class="form-control mb-2" required>
        <input type="hidden" name="coverNew" value=""> <!-- to save the coverUrl from the main.js -->
        <textarea name="reviewNew" placeholder="Review Text" class="form-control mb-2" required></textarea>
        <button type="submit" class="btn btn-primary w-100">Add Book Review</button>
      </form>
      <button class="btn btn-secondary mt-2" onclick="toggleNewItemForm()">Cancel</button>
    </div>
  </div>

  <?php foreach ($books as $item): ?>
    <div class="item">
      <!-- Linkes Div: Buchcover -->
      <div class="text-alignment custom-col custom-col-5">
        <?php if (!empty($item['url_book_cover']) && trim($item['url_book_cover']) !== "" && $item['url_book_cover'] !== "No cover available"): ?>
          <img src="<?= htmlspecialchars($item['url_book_cover']) ?>" alt="Book Cover">
        <?php else: ?>
          <p>No Book Cover Available</p>
        <?php endif; ?>
      </div>
      <!-- Rechtes Div: Buchdetails -->
      <div class="custom-col custom-col-7">
        <div class="book-details">
          <p id="title<?= $item['id'] ?>"><strong>Title:</strong>
            <?= htmlspecialchars($item['book_title']) ?>
          </p>
          <p id="author<?= $item['id'] ?>"><strong>Author:</strong>
            <?= htmlspecialchars($item['review_author']) ?>
          </p>
          <p id="date<?= $item['id'] ?>"><strong>Date of Review:</strong>
            <?= date("l, F j, Y", strtotime($item['review_date'])) ?>
          </p>
          <p id="text<?= $item['id'] ?>" class="text-truncated">
            <strong>Review:</strong>
            <?= htmlspecialchars($item['review_text']) ?>
          </p>
        </div>

        <div class="button-group">
          <?php $isTruncatedFallback = strlen($item['review_text']) > 100; ?>
          <?php if ($isTruncatedFallback): ?>
            <button class="read-more-btn" onclick="toggleText('<?= $item['id'] ?>')">Read more</button>
          <?php endif; ?>

          <form action="javascript:void(0);" style="display: inline;">
            <button type="button" class="btn btn-edit" onclick="enableEdit('<?= $item['id'] ?>')">Edit</button>
          </form>
          <form action="/delete/<?= $item['id'] ?>" method="POST" style="display: inline;">
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <button class="add read-more-btn" type="button" href="/" onclick="toggleNewItemForm()">Add new book review</button>

</div>

<?php include 'footer.php'; ?>