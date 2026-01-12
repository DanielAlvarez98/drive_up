//previe imagen
FilePond.registerPlugin(

  FilePondPluginImagePreview,

);

document.querySelectorAll('.image-preview-create').forEach(input => {
  FilePond.create(input, {
    name: "imagen",
    storeAsFile: true,
    allowImagePreview: true,
    required: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    fileValidateTypeDetectType: (source, type) =>
      new Promise(resolve => resolve(type)),
  });
});

//chatbox
const faqs = [
  {
    q: "¿Qué puedo hacer en Drive UP?",
    a: "En Drive UP puedes registrar y gestionar la información de tu vehículo, controlar mantenimientos, gastos, documentos y recibir alertas importantes."
  },
  {
    q: "¿Cómo empiezo a usar el sistema?",
    a: "Solo debes registrar un vehículo y completar la información básica para empezar a usar todas las funcionalidades."
  },
  {
    q: "¿Cómo registro mi primer vehículo?",
    a: "Ingresa al módulo “Vehículos”, haz clic en “Agregar vehículo” y completa los datos solicitados."
  },
  {
    q: "¿Qué datos necesito para registrar un vehículo?",
    a: "Necesitas marca, modelo, año, placa, kilometraje inicial y tipo de combustible."
  },
  {
    q: "¿Puedo registrar más de un vehículo?",
    a: "Sí, Drive UP permite registrar y gestionar varios vehículos desde una misma cuenta."
  },
  {
    q: "¿Cómo registro un mantenimiento?",
    a: "Ve al módulo “Mantenimientos”, selecciona el vehículo y haz clic en “Agregar mantenimiento”."
  },
  {
    q: "¿Cada cuánto debo realizar el mantenimiento?",
    a: "Depende del uso del vehículo, pero Drive UP te ayuda a llevar el control por kilometraje y fechas."
  },
  {
    q: "¿Cómo activo las alertas?",
    a: "Las alertas se activan automáticamente al registrar mantenimientos y kilometraje."
  },
  {
    q: "¿Qué documentos puedo registrar?",
    a: "Puedes registrar SOAT, revisión técnica, seguro y otros documentos importantes."
  },
  {
    q: "¿El sistema avisa si un documento vence?",
    a: "Sí, Drive UP envía alertas cuando un documento está próximo a vencer."
  },
  {
    q: "No puedo registrar información, ¿qué hago?",
    a: "Verifica los campos obligatorios o contacta a supportDriveUP@gmail.com"
  },
  {
    q: "¿Cada cuántos km se cambia el aceite?",
    a: "Generalmente entre 5,000 y 10,000 km, según el vehículo y el aceite."
  }
];

const chatBubble = document.getElementById('chat-bubble');
const chatBox = document.getElementById('chat-box');
const closeChat = document.getElementById('close-chat');
const chatContent = document.getElementById('chatContent');
const questionsBox = document.getElementById('questionsBox');

chatBubble.onclick = () => chatBox.classList.remove('chat-hidden');
closeChat.onclick = () => chatBox.classList.add('chat-hidden');

function addMessage(text, isUser = false) {
  const div = document.createElement('div');
  div.className = 'chat-message' + (isUser ? ' user' : '');
  div.innerText = text;
  chatContent.insertBefore(div, questionsBox);
  chatContent.scrollTop = chatContent.scrollHeight;
}

function renderQuestions() {
  questionsBox.innerHTML = '';
  faqs.forEach((item, index) => {
    const btn = document.createElement('button');
    btn.className = 'btn btn-outline-primary btn-sm w-100 mb-2';
    btn.innerText = item.q;
    btn.onclick = () => selectQuestion(index);
    questionsBox.appendChild(btn);
  });
}

function selectQuestion(index) {
  const item = faqs[index];

  addMessage(item.q, true);
  questionsBox.innerHTML = '';

  setTimeout(() => {
    addMessage(item.a);
    renderQuestions();
  }, 500);
}

addMessage("👋 Hola, soy el asistente de Drive UP. ¿En qué puedo ayudarte?");
renderQuestions();


//carrusel
const multipleItemCarousel = document.querySelector("#testimonialCarousel");

if (window.matchMedia("(min-width:576px)").matches) {

  var carouselWidth = $(".carousel-inner")[0].scrollWidth;
  var cardWidth = $(".carousel-item").outerWidth(true);
  var scrollPosition = 0;

  setInterval(function () {
    if (scrollPosition < carouselWidth - cardWidth * 3) {
      scrollPosition += cardWidth;
    } else {
      scrollPosition = 0;
    }

    $(".carousel-inner").animate(
      { scrollLeft: scrollPosition },
      800
    );
  }, 3000);

  $(".carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 3) {
      scrollPosition += cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
  });

  $(".carousel-control-prev").on("click", function () {
    if (scrollPosition > 0) {
      scrollPosition -= cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 800);
    }
  });

} else {
  $(multipleItemCarousel).addClass("slide");
}

const carouselInner = document.querySelector(".carousel-inner");

let isDown = false;
let startX;
let scrollLeft;

carouselInner.addEventListener("mousedown", (e) => {
  isDown = true;
  carouselInner.classList.add("dragging");
  startX = e.pageX - carouselInner.offsetLeft;
  scrollLeft = carouselInner.scrollLeft;
});

carouselInner.addEventListener("mouseleave", () => {
  isDown = false;
  carouselInner.classList.remove("dragging");
});

carouselInner.addEventListener("mouseup", () => {
  isDown = false;
  carouselInner.classList.remove("dragging");
});

carouselInner.addEventListener("mousemove", (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - carouselInner.offsetLeft;
  const walk = (x - startX) * 1.5;
  carouselInner.scrollLeft = scrollLeft - walk;
});

