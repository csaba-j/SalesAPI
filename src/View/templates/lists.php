<?php

declare(strict_types=1);

use Csaba\SalesApi\DTO\ListDTO;
use Csaba\SalesApi\DTO\ListFormDTO;

$buildUrl = static function (array $params): string {
    return '?' . http_build_query($params);
};

$buildSortUrl = static function (string $column) use ($sort, $dir, $selectedListId, $buildUrl): string {
    $nextDir = ($sort === $column && $dir === 'asc') ? 'desc' : 'asc';

    $params = [
        'sort' => $column,
        'dir' => $nextDir,
    ];

    if ($selectedListId !== null && $selectedListId !== '') {
        $params['listId'] = $selectedListId;
    }

    return $buildUrl($params);
};

$buildListUrl = static function (string $listId) use ($sort, $dir, $buildUrl): string {
    return $buildUrl([
        'sort' => $sort,
        'dir' => $dir,
        'listId' => $listId,
    ]);
};

$buildBackUrl = static function () use ($sort, $dir, $buildUrl): string {
    return $buildUrl([
        'sort' => $sort,
        'dir' => $dir,
    ]);
};

$getSortIndicator = static function (string $column) use ($sort, $dir): string {
    if ($sort !== $column) {
        return '';
    }

    return $dir === 'asc' ? ' ^' : ' v';
};
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Sales API</title>
    <link rel="stylesheet" href="/assets/css/premium-minimal.css">
</head>
<body>
<main class="page">
    <h1 class="page-title">Sales API Lists</h1>
    <p class="page-subtitle">V&aacute;lassz egy list&aacute;t a sorra kattintva, &eacute;s n&eacute;zd meg az els&#337; 20 &#369;rlapot.</p>

    <?php if (!empty($error)) { ?>
        <h2>Hiba történt: <?php echo $error ?></h2>
    <?php } else { ?>

    <?php if (empty($lists)) { ?>
        <p class="empty-state empty-state--full">Nem tal&aacute;lhat&oacute; lista.</p>
    <?php } else { ?>
        <?php if ($selectedList === null) { ?>
            <section class="card">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <a class="sort-link" href="<?php echo htmlspecialchars($buildSortUrl('name'), ENT_QUOTES, 'UTF-8'); ?>">
                                N&eacute;v <span class="sort-indicator"><?php echo $getSortIndicator('name'); ?></span>
                            </a>
                        </th>
                        <th>
                            <a class="sort-link" href="<?php echo htmlspecialchars($buildSortUrl('size'), ENT_QUOTES, 'UTF-8'); ?>">
                                M&eacute;ret <span class="sort-indicator"><?php echo $getSortIndicator('size'); ?></span>
                            </a>
                        </th>
                        <th>
                            <a class="sort-link" href="<?php echo htmlspecialchars($buildSortUrl('createdAt'), ENT_QUOTES, 'UTF-8'); ?>">
                                L&eacute;trehoz&aacute;s d&aacute;tuma <span class="sort-indicator"><?php echo $getSortIndicator('createdAt'); ?></span>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var ListDTO $list */
                    foreach ($lists as $list) {
                        ?>
                        <tr
                            data-href="<?php echo htmlspecialchars($buildListUrl($list->id), ENT_QUOTES, 'UTF-8'); ?>"
                            class="list-row"
                        >
                            <td><?php echo htmlspecialchars($list->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo $list->size; ?></td>
                            <td><?php echo $list->createdAt->format('Y-m-d'); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section>
        <?php } ?>

        <?php if ($selectedList !== null) { ?>
            <section class="card">
                <div class="section-header">
                    <a class="back-button" href="<?php echo htmlspecialchars($buildBackUrl(), ENT_QUOTES, 'UTF-8'); ?>">Vissza</a>
                    <h2 class="section-title">
                        A(z) "<?php echo htmlspecialchars($selectedList->name, ENT_QUOTES, 'UTF-8'); ?>" list&aacute;hoz tartoz&oacute; &#369;rlapok (max. 20)
                    </h2>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Azonos&iacute;t&oacute;</th>
                        <th>N&eacute;v</th>
                        <th>Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($selectedListForms)) { ?>
                        <tr>
                            <td colspan="3" class="empty-state">Ehhez a list&aacute;hoz nincs &#369;rlap.</td>
                        </tr>
                    <?php } else { ?>
                        <?php
                        /** @var ListFormDTO $form */
                        foreach ($selectedListForms as $form) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($form->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($form->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($form->link, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php echo htmlspecialchars($form->link, ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </section>
        <?php } ?>
    <?php } ?>
    <?php } ?>
</main>

<script>
    document.querySelectorAll('tr[data-href]').forEach(function (row) {
        row.addEventListener('click', function () {
            window.location.href = row.dataset.href;
        });
    });
</script>
</body>
</html>
