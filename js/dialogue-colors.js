(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const colorPalette = [
            "#333",     // 0: Dark Grey (default)
            "#800",     // 1: Red
            "#808080",  // 2: Grey
            "#777",     // 3: Medium Grey
            "#4fb300",  // 4: Light Green
            "#000",     // 5: Black
            "#7f401a",  // 6: Orange
            "#0C5",     // 7: Green
            "#640",     // 8: Brown
            "#9f9f14",  // 9: Yellow
            "#6b1d6b",  // 10: Purple
            "#bb0000",  // 11: Light Red
            "#5d5d5d",  // 12: Light Grey
            "#00A",     // 13: Blue
            "#08F",     // 14: Light Blue
            "#00d4aa"   // 15: Cyan
        ];

        const paletteLength = colorPalette.length;

        // Simple but effective hash function
        const generateHash = (str) => {
            let hash = 0;
            // Trim string for consistent hashing
            const text = str.trim();

            for (const char of text) {
                hash = ((hash << 5) - hash) + char.charCodeAt(0);
                hash |= 0; // Convert to 32-bit integer
            }
            return hash;
        };

        // Apply to all <strong> elements
        document.querySelectorAll('strong').forEach(el => {
            const textContent = el.textContent.trim();

            // Only apply to text that contains colon, indicative of dialogue "Speaker: line"
            if (!textContent.includes(':')) return;

            // Skip if the element already has a custom 'data-dialogue-colour' attribute to prevent recoloring
            if (el.hasAttribute('data-dialogue-colour')) return;

            const hash = generateHash(textContent);
            const colorIndex = Math.abs(hash % paletteLength);
            const color = colorPalette[colorIndex];

            el.style.color = color;
            el.setAttribute('data-dialogue-colour', color);  // mark processed
        });
    });
})();