const burger = document.querySelector('.burger');
const menu = document.querySelector('.header__menu');

if (burger && menu) {
    burger.addEventListener('click', () => {
        menu.classList.toggle('active');
        document.body.classList.toggle('lock');
    });
}

const tabs = document.querySelectorAll('[data-tab]');
const panels = document.querySelectorAll('[data-panel]');

function switchTab(tabId) {
    tabs.forEach(btn => btn.classList.remove('active'));
    panels.forEach(div => div.classList.remove('active'));

    const activeTab = document.querySelector(`[data-tab="${tabId}"]`)
    const activePanel = document.querySelector(`[data-panel="${tabId}"]`)

    if (activeTab) activeTab.classList.add('active');
    if (activePanel) activePanel.classList.add('active');
}

tabs.forEach(btn => {
    btn.addEventListener('click', function() {
        const tabId = this.dataset.tab;
        switchTab(tabId);
    });
});

switchTab('login');