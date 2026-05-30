const Menu = document.querySelectorAll(".Menu");
const links = document.querySelectorAll(".nav-column2 .links");

Menu.forEach(Menus => {
  Menus.addEventListener("click", () => {

    links.forEach(l => {

      l.classList.remove("nav-links-js2");
      setTimeout (() => {
          l.classList.toggle("nav-links-js");
      }, 50)

    })

  })

})


const check = document.querySelectorAll(".nav-column2 .links .home");

check.forEach(c => {
   c.addEventListener("click", (() => {
        links.forEach(l => {
            l.classList.add("nav-links-js2");
        })
   }))
})


var swiper = new Swiper(".mySwiper1", {
  slidesPerView: 1,
  spaceBetween: 30,
  effect: "fade",
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


var swiper = new Swiper(".mySwiper6", {
  slidesPerView: 1,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    576: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
  },
});


var swiper = new Swiper(".mySwiper7", {
  slidesPerView: 1,
  spaceBetween: 10,
  // centeredSlides: true,
  autoplay: {
    speed: 3000,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {

    0: {
      slidesPerView: 2,
      spaceBetween: 0,
    },

    375: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    576: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 6,
      spaceBetween: 20,
    },
  },
});


// ProductDetails.php      Start
let qty_input = document.querySelector("#qty-input");

function plus() {

  document.getElementById("qty-input").value++;

}

function minus() {
  if (qty_input.value > 1) {
    document.getElementById("qty-input").value--;
  }
}
// ProductDetails.php      End


// Billing Page --- Start

let success_msg = document.querySelector(".Order-Success-msg");

if (success_msg) {
  setTimeout(() => {
    success_msg.classList.add("Order-Success-msg-js");
  }, 100);

  setTimeout(() => {
    success_msg.classList.remove("Order-Success-msg-js");
  }, 8000);
}
// Billing Page --- End

// Auth Pages Success Message --- Start
let auth_success_msg = document.querySelector(".Auth-Success-msg");

if (auth_success_msg) {
  setTimeout(() => {
    auth_success_msg.classList.add("Auth-Success-msg-js");
  }, 100);

  setTimeout(() => {
    auth_success_msg.classList.remove("Auth-Success-msg-js");
  }, 5000); // hide after 5 seconds
}
// Auth Pages Success Message --- End



// Collection --- Page --- Start
const priceButtons = document.querySelectorAll(".collection-price");
const dropdowns = document.querySelectorAll(".price-dropdown");

priceButtons.forEach(button => {
  button.addEventListener("click", () => {

    const dropdown = button.closest(".price").querySelector(".price-dropdown");
    const isOpen = dropdown.classList.contains("price-dropdown-js");

    dropdowns.forEach(drop => {
      drop.classList.remove("price-dropdown-js");
    });

    if (!isOpen) {
      dropdown.classList.add("price-dropdown-js");
    }

  });
});



let timer;

function applyFilters() {
  const data = new FormData();
  data.append('from', document.getElementById('from').value || 0);
  data.append('to', document.getElementById('to').value || 999999);

  document.querySelectorAll('input[type="checkbox"]:checked')
    .forEach(cb => data.append('categories[]', cb.value));

  fetch('filter_products.php', { method: 'POST', body: data })
    .then(r => r.json())
    .then(products => {

      if (products.length === 0) {
        document.getElementById('products-container').innerHTML = '<p style="text-align:center;">No products found</p>';
        return;
      }

      document.getElementById('products-container').innerHTML = products.map(p => `
                <div class="col-lg-3">
                    <div class="swiper-slide">
                        <div class="S3-column1 S6-column1 collection-S3-column1">
                            <div class="img-div">
                                <div class="img" style="background-image: url('../assets/images/${p.main_image}');"></div>
                                <div class="overlay">
                                    <div class="sale"><p>Sale</p></div>
                                    <div class="icons">
                                        <a href="productDetails.php?id=${p.id}"><i class="ri-list-check"></i></a>
                                        <a href=""><i class="ri-eye-line"></i></a>
                                        <a href=""><i class="ri-heart-line"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-div">
                                <div class="text1"><p>${p.name}</p></div>
                                <div class="text2">
                                    <p>$${p.new_price}</p>
                                    <span>$${p.old_price}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
    });
}

function resetFilters() {
  document.getElementById('from').value = '';
  document.getElementById('to').value = '';
  applyFilters();
}
function resetCheckbox() {
  document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
  applyFilters();
}


document.getElementById('from').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(applyFilters, 500); });
document.getElementById('to').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(applyFilters, 500); });


document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.addEventListener('change', applyFilters));



// Collection --- Page --- End



// FAQS PAGE --- Start

document.querySelectorAll('.faq-question').forEach(button => {
  button.addEventListener('click', () => {
    const accordionItem = button.parentElement;
    const isOpen = accordionItem.classList.contains('active');


    document.querySelectorAll('.faq-item').forEach(item => {
      item.classList.remove('active');
      const icon = item.querySelector('i');
      icon.classList.remove('ri-subtract-line');
      icon.classList.add('ri-add-line');
    });


    if (!isOpen) {
      accordionItem.classList.add('active');
      const icon = button.querySelector('i');
      icon.classList.remove('ri-add-line');
      icon.classList.add('ri-subtract-line');
    }
  });
});


// FAQS PAGE --- End

// AOS Library 
