function waitForElement(selector, callback, checkFrequencyInMs, timeoutInMs) {
  var startTimeInMs = Date.now();
  (function loopSearch() {
    if (document.querySelector(selector) != null) {
      callback();
      return;
    } else {
      setTimeout(function () {
        if (timeoutInMs && Date.now() - startTimeInMs > timeoutInMs) return;
        loopSearch();
      }, checkFrequencyInMs);
    }
  })();
}
function skipActivation() {
  const n2popup = document.querySelector('[data-modal-type="activate"]');
  if (n2popup) {
    n2popup.querySelector(".n2_modal__button > a.n2_button--grey").click();
  }
}
document.addEventListener(
  "click",
  function (e) {
    // SKIP SMART SLIDER 3 PRO ACTIVATION
    if (e.target.closest(".n2_new_project__box")) {
      waitForElement('[data-modal-type="activate"]', skipActivation, 300, 3000);
    }
    // CONTENT WIDTH
    if (e.target.closest(".acf-field-638946c257884 .acf-button-group input")) {
      changePageWidth();
    }
  },
  false
);

// SKIP SMART SLIDER 3 PRO ACTIVATION
const n2link = document.querySelector(".n2_page_activate__button_dont_show");
if (n2link) {
  n2link.querySelector("a").click();
}

// ACF PAGE WIDTH
waitForElement('[data-key="field_638946c257884"]', changePageWidth, 300, 3000);

// CHANGE PAGE WIDTH
function changePageWidth() {
  pageWidth = document.querySelector(
    'input[name="acf[field_638946c257884]"]:checked'
  );
  if (pageWidth.value == "narrow") {
    document.querySelector("body").classList.add("-narrow");
  } else {
    document.querySelector("body").classList.remove("-narrow");
  }
}

// TEST WEBHOOK
document.addEventListener("DOMContentLoaded", () => {
  const testWebhookButton = document.getElementById("sp-test-webhook");

  if (testWebhookButton) {
    testWebhookButton.addEventListener("click", (e) => {
      e.preventDefault();

      testWebhookButton.disabled = true;
      const fetchUrl = "/wp-json/sp/v1/test-webhook";
      const webhookUrl =
        e.target.parentElement.parentElement.parentElement.querySelector(
          "input[type='text']"
        ).value;

      fetch(fetchUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          webhook_url: webhookUrl,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          alert("Test webhook sent successfully!" + data.message);
        })
        .catch((error) => {
          const errorMessage = error.message || "Error sending test webhook.";
          alert(errorMessage);
        })
        .finally(() => {
          testWebhookButton.disabled = false;
        });
    });
  }
});
