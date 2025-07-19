// Function to set the current selected item in feature
function setCurrent(selectedId, otherId1, otherId2) {
    document
        .getElementById(selectedId)
        .classList.add(
            "backdrop-blur-[6px]",
            "backdrop-saturate-[183%]",
            "bg-[rgba(17,25,40,0.16)]",
            "scale-105"
        );
    document
        .getElementById(otherId1)
        .classList.remove(
            "backdrop-blur-[6px]",
            "backdrop-saturate-[183%]",
            "bg-[rgba(17,25,40,0.16)]",
            "scale-105"
        );
    document
        .getElementById(otherId2)
        .classList.remove(
            "backdrop-blur-[6px]",
            "backdrop-saturate-[183%]",
            "bg-[rgba(17,25,40,0.16)]",
            "scale-105"
        );
}
// Function to change the image
function changeImage(imageName) {
    const items = document.querySelectorAll(".carousel-item");
    items.forEach((item) => item.classList.add("hidden"));
    const selectedItem = Array.from(items).find((item) =>
        item.querySelector("img").src.includes(imageName)
    );
    if (selectedItem) {
        selectedItem.classList.remove("hidden");
    }
}
setCurrent("link-item1", "link-item2", "link-item3");
changeImage("first.png");

// javascript for scroll to features
document
    .querySelectorAll(
        "#scrollToFeatures, #scrollingToFeatures, #scrollToFeaturesFooter"
    )
    .forEach((el) =>
        el.addEventListener("click", (e) => {
            e.preventDefault();
            const featuresSection = document.getElementById("features");
            window.scrollTo({
                top: featuresSection.offsetTop - 10,
                behavior: "smooth",
            });
        })
    );

document
    .querySelectorAll("#scrollToFeaturesTo, #scrollToTestimonialsFooter")
    .forEach((el) =>
        el.addEventListener("click", (e) => {
            e.preventDefault();
            const testimonialsSection = document.getElementById("testimonials");
            window.scrollTo({
                top: testimonialsSection.offsetTop - 10,
                behavior: "smooth",
            });
        })
    );

document
    .querySelectorAll("#scrollToFeedbackTo, #scrollToFeedbackFooter")
    .forEach((el) =>
        el.addEventListener("click", (e) => {
            e.preventDefault();
            const feedbackSection = document.getElementById("feedbacks");
            window.scrollTo({
                top: feedbackSection.offsetTop - 10,
                behavior: "smooth",
            });
        })
    );

document.addEventListener("DOMContentLoaded", function () {
    function smoothScroll(target) {
        const element = document.querySelector(target);
        if (element) {
            window.scrollTo({
                top: element.offsetTop - 10, // Adjust for fixed headers if necessary
                behavior: "smooth",
            });
        }
    }

    document
        .getElementById("scrollToFeaturesNav")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default anchor behavior
            smoothScroll("#features");
        });

    document
        .getElementById("scrollToFeaturesToNav")
        .addEventListener("click", function (event) {
            event.preventDefault();
            smoothScroll("#testimonials");
        });

    document
        .getElementById("scrollToFeedbackToNav")
        .addEventListener("click", function (event) {
            event.preventDefault();
            smoothScroll("#feedbacks");
        });
});
