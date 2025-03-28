document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("th").forEach(th => {
        let resizer = document.createElement("div");
        resizer.classList.add("resizer");
        th.appendChild(resizer);
        resizer.addEventListener("mousedown", initResize);
    });

    function initResize(e) {
        let th = e.target.parentElement;
        let startX = e.clientX;
        let startWidth = th.offsetWidth;

        function resize(e) {
            th.style.width = startWidth + (e.clientX - startX) + "px";
        }

        function stopResize() {
            document.removeEventListener("mousemove", resize);
            document.removeEventListener("mouseup", stopResize);
        }

        document.addEventListener("mousemove", resize);
        document.addEventListener("mouseup", stopResize);
    }
});
