<?php $title = "Éditer les liens de navigation"; ?>

<div class="container mt-5">
    <h2>Éditer les liens de navigation</h2>
    <form id="navForm" action="index.php?controller=nav&action=adjustOrder" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $index => $link) : ?>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="names[<?= $link['id'] ?>]" value="<?= htmlspecialchars($link['name']) ?>">
                        </td>
                        <td>
                            <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
                                <div class="w-100 d-flex flex-column flex-sm-row">
                                    <div class="me-sm-2 mb-2 mb-sm-0 flex-grow-1 flex-sm-grow-0">
                                        <button type="button" class="btn btn-sm btn-secondary move-up w-100">Monter</button>
                                    </div>
                                    <div class="flex-grow-1 flex-sm-grow-0">
                                        <button type="button" class="btn btn-sm btn-secondary move-down w-100">Descendre</button>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary mt-3">Sauvegarder les modifications</button>
    </form>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.querySelector("#navForm tbody");

        tableBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('move-up') || e.target.classList.contains('move-down')) {
                const row = e.target.closest('tr');
                if (e.target.classList.contains('move-up')) {
                    // Monter la ligne
                    row.previousElementSibling?.insertAdjacentElement('beforebegin', row);
                } else {
                    // Descendre la ligne
                    row.nextElementSibling?.insertAdjacentElement('afterend', row);
                }
            }
        });
    });
</script>