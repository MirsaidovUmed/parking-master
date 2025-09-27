const paginationContainer = document.querySelector(".pagination-container");
const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");
const listItems = paginatedList.querySelectorAll("li");
const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");

const paginationLimit = 6;
const pageCount = Math.ceil(listItems.length / paginationLimit);
let currentPage = 1;

const disableButton = (button) => {
  button.classList.add("disabled");
  button.setAttribute("disabled", true);
};

const enableButton = (button) => {
  button.classList.remove("disabled");
  button.removeAttribute("disabled");
};

const handlePageButtonsStatus = () => {
  if (currentPage === 1) {
    disableButton(prevButton);
  } else {
    enableButton(prevButton);
  }

  if (currentPage === pageCount) {
    disableButton(nextButton);
  } else {
    enableButton(nextButton);
  }
};

const handleActivePageNumber = () => {
  const pageButtons = paginationNumbers.querySelectorAll(".pagination-number");
  pageButtons.forEach((button) => {
    button.classList.remove("active");
    const pageIndex = Number(button.getAttribute("page-index"));
    if (pageIndex === currentPage) {
      button.classList.add("active");
    }
  });
};

const appendPageNumber = (index) => {
  const pageNumber = document.createElement("button");
  pageNumber.className = "pagination-number";
  pageNumber.innerHTML = index;
  pageNumber.setAttribute("page-index", index);
  pageNumber.setAttribute("aria-label", "Page " + index);

  if (index === currentPage) {
    pageNumber.classList.add("active");
  }

  paginationNumbers.appendChild(pageNumber);
};

const getPaginationNumbers = () => {
  paginationNumbers.innerHTML = "";

  if (pageCount <= 7) {
    for (let i = 1; i <= pageCount; i++) {
      appendPageNumber(i);
    }
  } else {
    if (currentPage <= 4) {
      for (let i = 1; i <= 5; i++) {
        appendPageNumber(i);
      }
      paginationNumbers.innerHTML += '<span class="ellipsis">...</span>';
      appendPageNumber(pageCount);
    } else if (currentPage >= pageCount - 3) {
      appendPageNumber(1);
      paginationNumbers.innerHTML += '<span class="ellipsis">...</span>';
      for (let i = pageCount - 4; i <= pageCount; i++) {
        appendPageNumber(i);
      }
    } else {
      appendPageNumber(1);
      paginationNumbers.innerHTML += '<span class="ellipsis">...</span>';
      for (let i = currentPage - 1; i <= currentPage + 1; i++) {
        appendPageNumber(i);
      }
      paginationNumbers.innerHTML += '<span class="ellipsis">...</span>';
      appendPageNumber(pageCount);
    }
  }
};

const setCurrentPage = (pageNum) => {
  currentPage = pageNum;

  handleActivePageNumber();
  handlePageButtonsStatus();

  const prevRange = (pageNum - 1) * paginationLimit;
  const currRange = pageNum * paginationLimit;

  listItems.forEach((item, index) => {
    item.classList.add("hidden");
    if (index >= prevRange && index < currRange) {
      item.classList.remove("hidden");
    }
  });

  getPaginationNumbers();
};

window.addEventListener("load", () => {
  setCurrentPage(1);

  prevButton.addEventListener("click", () => {
    setCurrentPage(currentPage - 1);
  });

  nextButton.addEventListener("click", () => {
    setCurrentPage(currentPage + 1);
  });

  paginationContainer.addEventListener("click", (event) => {
    const target = event.target;
    if (target.classList.contains("pagination-number")) {
      const pageIndex = Number(target.getAttribute("page-index"));
      setCurrentPage(pageIndex);
    }
  });
});
