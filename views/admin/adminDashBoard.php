<section class="admin-dashboard container">

    <h2>Supprimer / Modifier Articles</h2>
        
    <table class="table">
        <thead>
            <th>#</th>
            <th>Titre</th>
            <th>Action</th>
        </thead>

        <tbody>
            <?php foreach($articles as $article) :?>
            <tr>
                <td>
                    <?= $article['id'] ?>
                </td>
                <td>
                    <?= $article['title'] ?>
                </td>
                <td>
                    <!-- BOUTON MODIFIER  -->
                    <a class="btn-upd" href="index.php?p=update&numArticle=<?= $article['id'] ?>">Modifier</a>

                    <!-- BOUTON SUPPRIMER  -->
                    <a class="btn-del" href="index.php?p=deleteArticle&numArticle=<?= $article['id'] ?>">Supprimer</a>
            
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- PAGINATION DASHBOARD ADMIN ARTICLES -->
    <nav class="pagination">
        <ul class="flex">

            <li class="btn-pagination <?= ($currentPage ==1) ? 'disabled' : '' ?>">
                <a title="Page Précédente" href="index.php?p=admin&page=<?= $currentPage - 1 ?>"><i class="fas fa-chevron-left"></i></a>
            </li>

            <?php for($page = 1; $page <= $pages; $page++): ?>

                <li>
                    <a title="Page <?= $page ?>" href="index.php?p=admin&page=<?= $page ?>" class="<?= ($currentPage == $page) ? 'current-page' : '' ?>"><?= $page ?></a>
                </li>

            <?php endfor; ?>

            <li class="btn-pagination <?= ($currentPage == $pages) ? 'disabled' : '' ?>">
                <a title="Page Suivante" href="index.php?p=admin&page=<?= $currentPage + 1 ?>"><i class="fas fa-chevron-right"></i></a>
            </li>

        </ul>
    </nav>

</section>