function playSound(el, soundfile) {
    var embed = document.getElementById("embed");
    if (!embed) {
        var embed = document.createElement("embed");
        embed.id = "embed";
        embed.setAttribute("src", soundfile);
        embed.setAttribute("hidden", "true");
        el.appendChild(embed);
    } else {
        embed.parentNode.removeChild(embed);
    }
}