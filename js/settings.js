const tabs = document.querySelectorAll(".setting-content");
const tabButtons = document.querySelectorAll(".setting-title");

const tab_nav = function(tabButtonsClick) {
    tabs.forEach((settingtitle) => {
        settingtitle.classList.remove("active");
    });

    tabs.forEach((settingcontent) => {
        settingcontent.classList.remove("active");
    });

    tabButtons[tabButtonsClick].classList.add("active");
    tabs[tabButtonsClick].classList.add("active");
}

const resetTabs = function() {
    tabs.forEach((settingcontent) => {
        settingcontent.classList.remove("active");
    });

    tabButtons.forEach((tabButton) => {
        tabButton.classList.remove("active");
    });
};

tabButtons.forEach((tabButton, i) => {
    tabButton.addEventListener("click", () => {
        if (tabButton.classList.contains("active")) {
            resetTabs();
        } else {
            resetTabs();
            tab_nav(i);
        }
    });
});
