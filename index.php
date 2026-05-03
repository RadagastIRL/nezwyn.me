<?php
declare(strict_types=1);

$form_status = null;
$form_errors = [];
$form_values = ['name' => '', 'email' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form'] ?? '') === 'reservations') {
    $form_values['name']    = trim((string)($_POST['name'] ?? ''));
    $form_values['email']   = trim((string)($_POST['email'] ?? ''));
    $form_values['message'] = trim((string)($_POST['message'] ?? ''));

    if ($form_values['name'] === '')                                              $form_errors['name']    = 'Please tell us what to call you.';
    if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL))                 $form_errors['email']   = 'A working letter-address, please.';
    if (mb_strlen($form_values['message']) < 5)                                    $form_errors['message'] = 'A line or two is plenty.';
    if (mb_strlen($form_values['message']) > 2000)                                 $form_errors['message'] = 'A note, not a novella.';
    if (($_POST['hp'] ?? '') !== '')                                               $form_errors['hp']      = 'spam';

    if (!$form_errors) {
        $log_dir = __DIR__ . '/var';
        if (!is_dir($log_dir)) @mkdir($log_dir, 0775, true);
        $entry = sprintf(
            "[%s] %s <%s>\n%s\n----\n",
            date('c'),
            str_replace(["\r","\n"], ' ', $form_values['name']),
            str_replace(["\r","\n"], ' ', $form_values['email']),
            $form_values['message']
        );
        @file_put_contents($log_dir . '/messages.log', $entry, FILE_APPEND | LOCK_EX);
        $form_status = 'ok';
        $form_values = ['name' => '', 'email' => '', 'message' => ''];
    } else {
        $form_status = 'err';
    }
}

function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

$year = date('Y');
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Tinkerflare Lounge — Mind the sparks. The cider's excellent.</title>
<meta name="description" content="Tinkerflare Lounge: a working library that pours drinks, a small theater that doubles as a reading room, a tinkerer's workshop that serves dinner. Run by Nezwyn Tinkerflare.">
<meta name="theme-color" content="#F2E9D0" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#1A0F2A" media="(prefers-color-scheme: dark)">
<meta property="og:title" content="Tinkerflare Lounge">
<meta property="og:description" content="A library that serves dinner. Mind the sparks — the cider's excellent.">
<meta property="og:type" content="website">
<link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IM+Fell+DW+Pica+SC&family=IM+Fell+English:ital@0;1&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Caveat:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<a class="skip" href="#main">Skip to content</a>

<header class="site-header" role="banner">
  <nav class="topnav" aria-label="Primary">
    <a class="topnav__brand" href="#top" aria-label="Tinkerflare Lounge — home">
      <?php include __DIR__ . '/assets/img/seal.svg.php'; ?>
      <span class="topnav__brand-text">
        <span class="topnav__brand-name">Tinkerflare</span>
        <span class="topnav__brand-sub">Lounge</span>
      </span>
    </a>
    <input type="checkbox" id="navtoggle" class="navtoggle" aria-hidden="true">
    <label for="navtoggle" class="navtoggle__btn" aria-label="Open menu">
      <span></span><span></span><span></span>
    </label>
    <ul class="topnav__list">
      <li><a href="#lounge">The Lounge</a></li>
      <li><a href="#stage">Tonight on Stage</a></li>
      <li><a href="#kitchen">Kitchen &amp; Cellar</a></li>
      <li><a href="#library">The Library</a></li>
      <li><a href="#visit">Visit</a></li>
    </ul>
  </nav>
</header>

<main id="main">

  <section id="top" class="hero">
    <div class="hero__inner">
      <p class="hero__eyebrow"><span class="rule rule--brass"></span>est. in a slightly unreliable spellbook<span class="rule rule--brass"></span></p>

      <h1 class="wordmark" aria-label="Tinkerflare Lounge">
        <span class="wordmark__top">Tinkerflare</span>
        <span class="wordmark__amp" aria-hidden="true">
          <svg viewBox="0 0 220 18" preserveAspectRatio="none" focusable="false" aria-hidden="true">
            <path d="M0 9 L90 9" stroke="currentColor" stroke-width="1.2" fill="none"/>
            <path d="M130 9 L220 9" stroke="currentColor" stroke-width="1.2" fill="none"/>
            <circle cx="110" cy="9" r="3.2" fill="currentColor"/>
            <circle cx="100" cy="9" r="1" fill="currentColor"/>
            <circle cx="120" cy="9" r="1" fill="currentColor"/>
          </svg>
        </span>
        <span class="wordmark__bottom">Lounge</span>
      </h1>

      <p class="hero__tagline">&ldquo;Mind the sparks. The cider&rsquo;s excellent.&rdquo;</p>

      <ul class="hero__meta" aria-label="What we are">
        <li>Lounge</li><li aria-hidden="true">·</li>
        <li>Library</li><li aria-hidden="true">·</li>
        <li>Small Stage</li><li aria-hidden="true">·</li>
        <li>Roadhouse</li>
      </ul>

      <p class="hero__cta">
        <a class="btn btn--primary" href="#stage">See what&rsquo;s on</a>
        <a class="btn btn--ghost" href="#visit">Reserve a table</a>
      </p>
    </div>
    <div class="hero__sparks" aria-hidden="true">
      <span class="spark spark--1"></span>
      <span class="spark spark--2"></span>
      <span class="spark spark--3"></span>
      <span class="spark spark--4"></span>
    </div>
  </section>

  <section id="lounge" class="section section--cream">
    <div class="container container--narrow">
      <p class="kicker">A note from the proprietor</p>
      <h2 class="display">A library that serves dinner.</h2>
      <p class="lede">
        Tinkerflare Lounge is a working library that pours drinks, a small theater that
        doubles as a reading room, and a tinkerer&rsquo;s workshop that serves dinner. The
        candles are real. The calligraphy on the menu is mine. Most evenings end well; a
        few end with the lamps relit and a round on the house.
      </p>
      <p>
        I am Nezwyn Tinkerflare &mdash; gnomish arcane mage, reader-in-residence, and
        the one currently rewiring the chandelier. The spellbook is mostly reliable. The
        cider is reliably excellent. We lend books to anyone who promises to bring them
        back, host readings on the small stage, and keep the back booths warm for people
        who came in for one drink and stayed for three.
      </p>

      <p class="signature"><span>&mdash; Nezwyn</span></p>
    </div>
  </section>

  <section id="stage" class="section section--vellum">
    <div class="container">
      <p class="kicker"><span class="rule rule--brass"></span>Tonight on the Small Stage<span class="rule rule--brass"></span></p>
      <h2 class="display display--center">Programme</h2>

      <div class="programme">
        <article class="programme__card">
          <p class="programme__date"><span>Thursday</span><strong>7&nbsp;pm</strong></p>
          <h3 class="programme__title">Open Mic &amp; Open Margins</h3>
          <p>Bring three pages or three songs. The lamps stay low. The list opens at six.</p>
          <p class="programme__meta">No cover &middot; reservations welcome</p>
        </article>
        <article class="programme__card">
          <p class="programme__date"><span>Friday</span><strong>8&nbsp;pm</strong></p>
          <h3 class="programme__title">A Reading: <em>Letters from the Map&rsquo;s Edge</em></h3>
          <p>Selected correspondence, lightly footnoted, read aloud in the back room with cider service throughout.</p>
          <p class="programme__meta">£5 at the door &middot; menu available</p>
        </article>
        <article class="programme__card">
          <p class="programme__date"><span>Saturday</span><strong>9&nbsp;pm</strong></p>
          <h3 class="programme__title">Spellfizz &amp; Standards</h3>
          <p>A small jazz trio and a slightly larger drinks list. Booth seating only; expect a queue.</p>
          <p class="programme__meta">£8 at the door</p>
        </article>
        <article class="programme__card">
          <p class="programme__date"><span>Sunday</span><strong>3&nbsp;pm</strong></p>
          <h3 class="programme__title">Children&rsquo;s Story Hour</h3>
          <p>One story, one biscuit, one well-behaved illusion. Parents welcome to read along (or nap).</p>
          <p class="programme__meta">Free &middot; library card encouraged</p>
        </article>
      </div>
    </div>
  </section>

  <section id="kitchen" class="section section--violet">
    <div class="container container--narrow">
      <p class="kicker kicker--light">Kitchen &amp; Cellar</p>
      <h2 class="display display--light display--center">A short, honest menu.</h2>
      <p class="lede lede--light center">
        We cook what we like to eat and pour what we like to drink. The kitchen closes
        when the last reading ends; the cellar stays open a little longer.
      </p>

      <div class="menu">
        <div class="menu__col">
          <h3 class="menu__heading">From the Kitchen</h3>
          <dl class="menu__list">
            <div><dt>Hearth bread &amp; cultured butter</dt><dd>5</dd></div>
            <div><dt>Soup of the moment, bowl &amp; loaf</dt><dd>9</dd></div>
            <div><dt>Cheese board, three local, with quince</dt><dd>14</dd></div>
            <div><dt>Pot pie, root vegetables &amp; gravy</dt><dd>16</dd></div>
            <div><dt>Roast bird, dark bread, watercress</dt><dd>19</dd></div>
            <div><dt>Treacle tart, brown butter cream</dt><dd>7</dd></div>
          </dl>
        </div>
        <div class="menu__col">
          <h3 class="menu__heading">From the Cellar</h3>
          <dl class="menu__list">
            <div><dt>House cider, dry, by the glass</dt><dd>5</dd></div>
            <div><dt>House cider, by the jug</dt><dd>14</dd></div>
            <div><dt>Mulled wine, season permitting</dt><dd>6</dd></div>
            <div><dt>Spellfizz &mdash; gin, citrus, a misfire</dt><dd>9</dd></div>
            <div><dt>Lamplight &mdash; brandy, honey, smoke</dt><dd>10</dd></div>
            <div><dt>Tea, properly made, bottomless pot</dt><dd>4</dd></div>
          </dl>
        </div>
      </div>

      <p class="footnote footnote--light">
        Prices in coin of the realm. Substitutions cheerfully accommodated. The
        kitchen sometimes catches fire in a controlled, charming way; we apologise
        for nothing and refund where appropriate.
      </p>
    </div>
  </section>

  <section id="library" class="section section--cream">
    <div class="container">
      <div class="split">
        <div class="split__text">
          <p class="kicker">The Working Library</p>
          <h2 class="display">Borrow a book. Bring it back. Or don&rsquo;t.</h2>
          <p>
            The Lounge keeps a lending library of roughly two thousand volumes &mdash;
            field guides, slim novels, cookery, plays, an unreasonable number of
            atlases. There is no late fee. There is a small ledger at the bar; sign
            it, take what you like, and return it when you&rsquo;re done. Footnotes
            in the margin are encouraged.
          </p>
          <ul class="checks">
            <li>Two thousand volumes, and counting</li>
            <li>Bookplates pressed at the bar on request</li>
            <li>Reading nooks with proper lamps</li>
            <li>A standing offer to discuss anything you&rsquo;ve just read</li>
          </ul>
        </div>
        <aside class="split__card">
          <div class="bookplate">
            <p class="bookplate__top">Ex Libris</p>
            <div class="bookplate__seal">
              <?php include __DIR__ . '/assets/img/seal.svg.php'; ?>
            </div>
            <p class="bookplate__name">Tinkerflare Lounge</p>
            <p class="bookplate__line">This book belongs to the lending library at <em>Tinkerflare Lounge</em>. Read it slowly. Mark the margins kindly. Return it when the candles burn low.</p>
            <p class="bookplate__sig">&mdash; N.&nbsp;Tinkerflare, prop.</p>
          </div>
        </aside>
      </div>
    </div>
  </section>

  <section id="visit" class="section section--vellum">
    <div class="container container--narrow">
      <p class="kicker"><span class="rule rule--brass"></span>Visit<span class="rule rule--brass"></span></p>
      <h2 class="display display--center">Reserve a table, send a letter.</h2>

      <div class="visit-grid">
        <div>
          <h3 class="subhead">Hours</h3>
          <table class="hours">
            <tr><th scope="row">Monday</th><td>closed (re-shelving)</td></tr>
            <tr><th scope="row">Tue&ndash;Thu</th><td>4&nbsp;pm &ndash; 11&nbsp;pm</td></tr>
            <tr><th scope="row">Fri&ndash;Sat</th><td>3&nbsp;pm &ndash; 1&nbsp;am</td></tr>
            <tr><th scope="row">Sunday</th><td>1&nbsp;pm &ndash; 9&nbsp;pm</td></tr>
          </table>

          <h3 class="subhead">Find us</h3>
          <p class="address">
            14 Lampwick Lane<br>
            (the door with the brass spark)<br>
            <a href="mailto:hello@tinkerflare.lounge">hello@tinkerflare.lounge</a>
          </p>
        </div>

        <div>
          <h3 class="subhead">Send a note</h3>

          <?php if ($form_status === 'ok'): ?>
            <div class="notice notice--ok" role="status">
              <p><strong>Thank you.</strong> Your note is in the bar ledger. Nezwyn will write back when the candles are lit.</p>
            </div>
          <?php endif; ?>

          <?php if ($form_status === 'err'): ?>
            <div class="notice notice--err" role="alert">
              <p><strong>One moment &mdash;</strong> a few details need a second look:</p>
              <ul>
                <?php foreach ($form_errors as $k => $v) if ($k !== 'hp') echo '<li>' . h($v) . '</li>'; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="form" method="post" action="#visit" novalidate>
            <input type="hidden" name="form" value="reservations">
            <p class="form__hp" aria-hidden="true">
              <label>Leave this empty <input type="text" name="hp" tabindex="-1" autocomplete="off"></label>
            </p>

            <p class="form__row">
              <label for="f-name">Your name</label>
              <input id="f-name" name="name" type="text" required maxlength="120" value="<?= h($form_values['name']) ?>" autocomplete="name">
            </p>
            <p class="form__row">
              <label for="f-email">Letter-address</label>
              <input id="f-email" name="email" type="email" required maxlength="200" value="<?= h($form_values['email']) ?>" autocomplete="email">
            </p>
            <p class="form__row">
              <label for="f-message">Note</label>
              <textarea id="f-message" name="message" rows="5" required maxlength="2000"><?= h($form_values['message']) ?></textarea>
              <span class="form__hint">Reservation, reading enquiry, or just a kind word.</span>
            </p>
            <p class="form__row form__actions">
              <button class="btn btn--primary" type="submit">Send it through</button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>

<footer class="site-footer">
  <div class="container container--narrow center">
    <div class="footer-seal" aria-hidden="true">
      <?php include __DIR__ . '/assets/img/seal.svg.php'; ?>
    </div>
    <p class="footer-tag">&ldquo;Mind the sparks. The cider&rsquo;s excellent.&rdquo;</p>
    <p class="footer-meta">
      Tinkerflare Lounge &middot; 14 Lampwick Lane &middot;
      <a href="mailto:hello@tinkerflare.lounge">hello@tinkerflare.lounge</a>
    </p>
    <p class="footer-fine">&copy; <?= h((string)$year) ?> Tinkerflare Lounge. A library that serves dinner.</p>
  </div>
</footer>

</body>
</html>
