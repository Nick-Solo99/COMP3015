<dialog id="editModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center text-primary">Edit Article:</h3>
        <p class="pt-4 text-center text-base-content">Edit The Article Here.</p>
        <form method="post" class="card-body pt-1">
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-secondary">Title</span>
                </label>
                <input id="title" name="title" type="text" value="<?=isset($selectedArticle) ? $selectedArticle->getTitle() : ""?>" class="input input-bordered" required />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-secondary">Link</span>
                </label>
                <input id="link" name="link" type="text" value="<?=isset($selectedArticle) ? $selectedArticle->getUrl() : ""?>" class="input input-bordered" required />
            </div>
            <button type="submit" class="btn btn-outline btn-primary mt-4" name="applyChanges" value="<?=isset($selectedArticle) ? $selectedArticle->getId() : ""?>">
                Apply Changes
            </button>
            <?php if (isset($editError)) : ?>
                <div role="alert" class="alert alert-error">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span><?=htmlspecialchars($editError)?></span>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center text-primary">Delete Article:</h3>
        <p class="pt-4 text-center text-base-content">Are you sure you would like to delete the selected article?</p>
        <p class="px-8 text-center text-xl text-secondary"><?=isset($selectedArticle) ? $selectedArticle->getTitle() : ""?></p>
        <form method="post" class="card-actions justify-end">
            <button class="btn btn-outline btn-secondary mt-4">Cancel</button>
            <button type="submit" class="btn btn-error mt-4" name="confirmDelete" value="<?=isset($selectedArticle) ? $selectedArticle->getId() : ""?>">Delete</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<?php if (isset($editId) || isset($editError)): ?>
    <script>
        document.getElementById('editModal').showModal();
    </script>
<?php endif; ?>

<?php if (isset($deleteId)): ?>
    <script>
        document.getElementById('deleteModal').showModal();
    </script>
<?php endif; ?>