<article class="content recurring payments">
  <div class="above-article">
      <div class="breadcrumbs">
          
          
          
          <a href="/reference" class="crumb">Reference</a>
          
          
          <a href="/reference/merchant-api-reference" class="crumb">Merchant API Reference</a>
          
          <div class="crumb">Recurring Payments</div>
      </div>

      <div class="switch" data-server="sandbox">
          <div class="switch-option switch-option--active">Sandbox</div>
          <div class="switch-option switch-option--inactive">Live</div>
      </div>
  </div>

  <h1 class="full-page-path print-only">Reference » Merchant API Reference » Recurring Payments</h1>

  <h1>Recurring Payments<a name="recurring-payments" class="anchor" href="https://docs.checkout.com/reference/merchant-api-reference/recurring-payments#recurring-payments"><span class="header-link"></span></a></h1><p>Checkout.com’s <strong>Recurring Payments</strong> feature offers merchants the ability to take debit or credit card payments from customers on a recurring basis.  This flexible solution can be configured to support a variety of popular recurring payment models, including subscription services, and membership services for products or services.  </p>
<p><strong>Recurring Payments</strong> are based around the <em class="">Payment Plan</em> object, which can exist independently as a <em class="">Payment Plan</em> template or in association with a <em class="">Charge</em> request. This structure gives merchants the following options:</p>
<ul class="dotted">
<li>Create a single (standalone) <a href="reference/merchant-api-reference/recurring-payments/payment-plans" target="_blank">Payment Plan</a></li>
<li>Associate an existing <em class="">Payment Plan</em> with a <em class="">Charge</em> request to create a <a href="reference/merchant-api-reference/recurring-payments/customer-payment-plans/charge-with-existing-plan" target="_blank">Customer Payment Plan</a></li>
<li>Create a <em class="">Payment Plan</em> and <em class="">Charge</em> request simultaneously to create a <a href="reference/merchant-api-reference/recurring-payments/customer-payment-plans/charge-with-new-plan" target="_blank">Customer Payment Plan</a></li>
</ul>
</article>