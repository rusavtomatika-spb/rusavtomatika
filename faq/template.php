<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style scoped>
        * {
          margin: 0;
          padding: 0;
        }
        .column { padding: 0 !important; }
        .faq-section {
          padding: 40px 0.75rem;
        }
        @media (max-width: 1023px) {
          .faq-section { padding: 40px 0;}
        }
        .faq-header {
          margin-bottom: 30px;
          text-align: center;
        }
        .accordion-button:not(.collapsed) {
          background-color: #00ad61;
          color: #fff;
        }
        .accordion-button:focus {
          box-shadow: none;
          border-color: rgba(0,0,0,.125);
        }
        .accordion-item {
          margin-bottom: 10px;
          border: 1px solid rgba(0,0,0,.125);
          border-radius: 0.375rem;
        }
        .section-filter {
          margin-bottom: 30px;
        }
        .section-filter .btn {
          margin: 3px;
        }
        .accordion-item h2 {
          margin: 0;
        }
        .section-title {
          margin-top: 30px;
          margin-bottom: 20px;
          padding-bottom: 10px;
          border-bottom: 2px solid #00ad61;
          color: #333;
        }
        .section-title:first-child {
          margin-top: 0;
        }
        .btn-outline-primary, .btn {
          border: 1px solid #00ad61;
          color: #000;
        }
        .btn-outline-primary:hover, .btn:hover {
          border: 1px solid #00ad61;
          background: none;
          color: #000;
          text-decoration: none;
        }
        .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
          border: 1px solid #00ad61;
          background: #00ad61;
          color: #fff;
        }
        .faq-answer a {
          color: #0d6efd;
          text-decoration: none;
        }
        .faq-answer a:hover {
          text-decoration: underline;
        }
        .faq-answer ul {
          padding-left: 20px;
        }
        .faq-answer li {
          margin-bottom: 8px;
        }
    </style>
</head>
<body>

<div class="faq-section">
    <div class="faq-header">
        <h1>Часто задаваемые вопросы</h1>
    </div>

    <?php if (count($sections) > 1): ?>
        <div class="section-filter text-center">
            <a href="/faq/" class="btn btn-outline-secondary <?= empty($section_url) ? 'active' : '' ?>">Все разделы</a>
            <?php foreach ($sections as $section): ?>
                <a href="/faq/section/<?= urlencode($section['section_url']) ?>" 
                   class="btn btn-outline-primary <?= $section_url == $section['section_url'] ? 'active' : '' ?>">
                    <?= htmlspecialchars($section['section']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="justify-content-center w-100">
        <div class="col-lg-12 px-0">
            <?php if (empty($grouped_items)): ?>
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle"></i> Вопросы в этом разделе пока отсутствуют.
                </div>
            <?php else: ?>
                <?php 
                $section_index = 0;
                foreach ($grouped_items as $section_name => $section_data): 
                    $section_index++;
                    $accordion_id = 'accordion_' . $section_index;
                    $section_url_slug = $section_data['section_url'];
                ?>
                    <h3 class="section-title" id="<?= htmlspecialchars($section_url_slug) ?>">
                        <?= htmlspecialchars($section_name) ?>
                    </h3>
                    <div class="accordion" id="<?= $accordion_id ?>">
                        <?php 
                        $item_index = 0;
                        foreach ($section_data['items'] as $item): 
                            $item_index++;
                            $collapse_id = 'collapse_' . $section_index . '_' . $item_index;
                            $heading_id = 'heading_' . $section_index . '_' . $item_index;
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="<?= $heading_id ?>">
                                    <button class="accordion-button <?= $item_index !== 1 ? 'collapsed' : '' ?>" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#<?= $collapse_id ?>" 
                                            aria-expanded="<?= $item_index === 1 ? 'true' : 'false' ?>" 
                                            aria-controls="<?= $collapse_id ?>">
                                        <?= htmlspecialchars($item['question']) ?>
                                    </button>
                                </h2>
                                <div id="<?= $collapse_id ?>" 
                                     class="accordion-collapse collapse <?= $item_index === 1 ? 'show' : '' ?>" 
                                     aria-labelledby="<?= $heading_id ?>" 
                                     data-bs-parent="#<?= $accordion_id ?>">
                                    <div class="accordion-body faq-answer">
                                        <?= $item['answer'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>