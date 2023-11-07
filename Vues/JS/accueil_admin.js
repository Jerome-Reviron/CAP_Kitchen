const section = document.querySelector("section"),
        sidebar = section.querySelector(".sidebar"),
        toggle = section.querySelector(".toggle"),
        modeSwitch = section.querySelector(".toggle-switch"),
        modeText = section.querySelector(".mode-name");

        modeSwitch.addEventListener("click", () =>{
            section.classList.toggle("dark");
        });

        toggle.addEventListener("click", () =>{
            sidebar.classList.toggle("close");
        });