<div class="container">
	<h1 class="orange-text">LogRicola</h1>
	<p>
		LogRicolaは、ツイッタラーのためのアグリコラ戦績管理サイトです。アグリコラの戦績を保存し、サマリー画像をTwitterに投稿できます。点数計算機もついているので、点数計算がわからない方も安心です！
	</p>
	<?php if (! OAuth::check()): ?>
	<div class="center-align">
		<?= Html::anchor('oauth/login', 'Twitterでログイン', ['class' => 'btn btn-large blue']); ?>
	</div>
	<p>
		※自動的にツイート、フォローする事はありません
	</p>
	<?php endif; ?>
	<h2 class="teal-text" id="howto">使い方</h2>
	<ol>
		<li>Twitterアカウントでログイン</li>
		<li>メニューより「戦績入力」を選択</li>
		<li>案内に従って、ゲームの詳細や点数を入力</li>
		<li>入力が終わると、「戦績」に新しいページが追加されます</li>
		<li>さらに、戦績詳細ページから「Twitterに投稿する」を選択すると、以下のようなサマリー画像をTwitterに投稿できます！</li>
	</ol>
	<?= Asset::img('sample.png', ['class' => 'responsive-img']); ?>
	<h2 class="teal-text" id="browser">推奨環境</h2>
	<p>
		「LogRicola」を快適にご利用いただくために、以下のモダンブラウザ最新版のご利用を推奨します。
	</p>
	<ul class="browser-default">
		<li>Google Chrome</li>
		<li>Apple Safari</li>
		<li>Mozilla Firefox</li>
		<li>Microsoft Edge</li>
	</ul>
	<p>
		また、全ての機能をお使いいただくために、JavaScript、Cookieが使用できる状態でご利用ください。
	</p>
	<h2 class="teal-text" id="termsofuse">利用規約</h2>
	<p>
		「LogRicola」（以下、本サイト）では、より良いツール開発のためにGoogle Analyticsを使用しております。Googleに特定の情報（本サイトでアクセスしたページのURLやIPアドレスなど）を、個人を特定できない形で自動的に送信しています。<br>
		ブラウザ設定よりCookieの使用をオフにすることで、これを拒否することも可能ですが、本サイトの機能が使用できなくなります。<br>
		また、Googleのアクセス情報の収集・利用方法は、<a href="https://www.google.com/analytics/terms/jp.html" target="_blank" rel="noopener">Google Analyticsサービス利用規約</a>および<a href="https://policies.google.com/privacy?hl=ja&gl=jp" target="_blank" rel="noopener">Googleポリシーと規約</a>によって定められています。
	</p>
	<p>
		本サイトでは、Twitterのアカウントを用いて認証を行います。Twitter連携をしていただくことで、本サイトの全機能をお使いいただけます。自動で投稿されることはございませんのでご安心ください。
	</p>
	<p>
		本サイトの利用に関連してユーザ自身または第三者に生じた損害について、その賠償の責任を一切負いかねますことをご了承ください。
	</p>
</div>
