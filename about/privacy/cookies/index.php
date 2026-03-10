<?php

if (!defined('ENCODING')) {
    define('ENCODING', "UTF-8");
}

error_log($_SERVER['DOCUMENT_ROOT']);

global $CONTENT_ON_WIDE_SCREEN;
$CONTENT_ON_WIDE_SCREEN = false;

require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/prolog.php";

global $TITLE, $DESCRIPTION, $KEYWORDS, $extra_openGraph, $CANONICAL;

$TITLE = 'Cогласие на обработку данных | ООО «РУСАВТОМАТИКА»';
$DESCRIPTION = 'Политика обработки персональных данных и форма согласия посетителя сайта ООО «РУСАВТОМАТИКА». Условия использования сайта и защиты персональной информации.';
$KEYWORDS = 'политика конфиденциальности, персональные данные, согласие на обработку данных, обработка данных, защита информации, РусАвтоматика';
$CANONICAL = "https://www.rusavtomatika.com/about/privacy/";
$extra_openGraph = array(
    "openGraph_image" => "https://www.rusavtomatika.com/upload_files/images/openGraph_images/privacy.png",
    "openGraph_title" => "Политика конфиденциальности и согласие на обработку данных | ООО «РУСАВТОМАТИКА»",
    "openGraph_siteName" => "Русавтоматика"
);
?>
<div class="policy-container">
  <h1>Согласие посетителя сайта на обработку персональных данных </h1>
  <div class="company-tag">ООО «РУСАВТОМАТИКА»</div>

  <div class="consent-section">
    
    <div class="consent-content">
      <p>Я, Пользователь сайта www.rusavtomatika.com, настоящим добровольно и в своем интересе даю согласие ООО «РУСАВТОМАТИКА» (далее – Оператор) на обработку моих персональных данных, предоставляемых при использовании сайта.</p>
      
      <h4>Персональные данные, на обработку которых я даю согласие:</h4>
      <ul>
        <li>фамилия, имя, отчество;</li>
        <li>адрес электронной почты;</li>
        <li>номер телефона;</li>
        <li>название организации и должность (для юридических лиц);</li>
        <li>почтовый адрес;</li>
        <li>обезличенные статические сведения (собранные с помощью файлов «cookie»).</li>
      </ul>
      
      <h4>Цели обработки персональных данных:</h4>
      <ul>
        <li>осуществление связи со мной для заключения и исполнения договора купли-продажи товаров и/или договора оказания услуг;</li>
        <li>информирование меня посредством электронных писем о новых продуктах, услугах, специальных предложениях и мероприятиях;</li>
        <li>улучшение качества сайта и его содержания на основе анализа обезличенных данных о моих действиях на сайте.</li>
      </ul>
      
      <p>Я уведомлен(а), что имею право отозвать согласие на обработку персональных данных путем направления письменного уведомления на электронный адрес Оператора: <a href="mailto:sales@rusavtomatika.com">sales@rusavtomatika.com</a> с пометкой «Отзыв согласия на обработку персональных данных».</p>
      
      <p><strong>Согласие на обработку персональных данных действует с момента предоставления персональных данных до достижения цели обработки персональных данных.</strong></p>
      
      <p>Подтверждаю, что ознакомлен(а) с Политикой обработки персональных данных и согласен(на) с ее условиями.</p>
    </div>

    <div class="note">
      <strong>Сведения об Операторе:</strong>
      ООО «РУСАВТОМАТИКА»<br>
      Электронная почта для связи: <a href="mailto:sales@rusavtomatika.com">sales@rusavtomatika.com</a><br>
      Веб-сайт: <a href="https://www.rusavtomatika.com" target="_blank">www.rusavtomatika.com</a>
  </div>
</div>
<style>
  .policy-container {
      width: 100%;
      border-radius: 24px;
      box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
      padding: 48px 56px;
      transition: all 0.2s;
  }

  .policy-container h1 {
      font-size: 2.5rem;
      font-weight: 600;
      letter-spacing: -0.02em;
      margin-bottom: 8px;
      color: #0f172a;
      border-left: 6px solid #00ad61;
      padding-left: 24px;
  }

  .company-tag {
      font-size: 1rem;
      color: #475569;
      margin-bottom: 40px;
      margin-top: 8px;
      padding-left: 30px;
  }

  .policy-container h3 {
      font-size: 1.5rem;
      font-weight: 500;
      margin: 36px 0 16px 0;
      color: #1e293b;
      border-bottom: 2px solid #e2e8f0;
      padding-bottom: 8px;
  }
  
  .consent-section {
      margin-bottom: 48px;
  }
  
  .consent-section h3 {
      color: #00ad61;
      border-bottom-color: #00ad61;
  }
  
  .consent-section h4 {
      font-size: 1.2rem;
      font-weight: 500;
      margin: 24px 0 12px 0;
      color: #1e293b;
  }
  
  .consent-content {
      background: #f9fbfd;
      padding: 24px 32px;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      margin-top: 20px;
  }
  
  .consent-content p:last-child {
      margin-bottom: 0;
  }
  
  .consent-content strong {
      color: #00ad61;
  }

  .policy-container h3::before {
      content: "";
  }

  p {
      margin-bottom: 20px;
      font-size: 1.05rem;
  }

  .policy-container ul {
      margin: 16px 0 24px 24px;
      list-style-type: none;
  }

  .policy-container li {
      margin-bottom: 12px;
      padding-left: 28px;
      position: relative;
      font-size: 1.05rem;
  }

  .policy-container li::before {
      content: "•";
      color: #00ad61;
      font-weight: bold;
      font-size: 1.4rem;
      position: absolute;
      left: 4px;
      top: -6px;
  }

  .policy-container a {
      color: #00ad61;
      text-decoration: none;
      border-bottom: 1px dotted #94a3b8;
  }

  .policy-container a:hover {
      border-bottom: 1px solid #00ad61;
  }

  .policy-container strong {
      color: #0f172a;
      font-weight: 600;
  }

  .note {
      background: #f8fafc;
      padding: 18px 24px;
      border-radius: 16px;
      border-left: 4px solid #00ad61;
      margin: 28px 0;
      font-size: 1rem;
  }

  .note strong {
      display: block;
      margin-bottom: 6px;
      font-size: 1.1rem;
  }

  .policy-container .email {
      font-family: 'Courier New', monospace;
      background: #eef2ff;
      padding: 3px 8px;
      border-radius: 30px;
      font-weight: 500;
      color: #1d4ed8;
      border: 1px solid #cbd5e1;
      white-space: nowrap;
  }

  @media (max-width: 700px) {
      .policy-container {
          padding: 28px 20px;
      }
      .policy-container h1 {
          font-size: 2rem;
          padding-left: 16px;
      }
      .company-tag {
          padding-left: 22px;
      }
      .consent-content {
          padding: 16px 20px;
      }
  }

  .definition-item {
      margin: 12px 0 12px 24px;
      position: relative;
  }
  .definition-item strong {
      font-weight: 600;
      color: #0f172a;
  }
</style>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/abacus/epilog.php";?>