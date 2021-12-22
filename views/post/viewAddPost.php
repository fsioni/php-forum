<form method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" maxlength="200" class="form-control" name="title">
  </div>

  <div class="mb-3">
    <label for="content" class="form-label">Contenu</label>
      <textarea class="form-control" rows="10" name="content"></textarea>
  </div>

  <button type="submit" class="btn btn-primary" name="validate">Poster</button>
</form>