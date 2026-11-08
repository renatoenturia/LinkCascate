document.addEventListener('change', (event) => {
    const input = event.target;

    if (!(input instanceof HTMLInputElement) || input.type !== 'file') {
        return;
    }

    const labelId = input.dataset.fileLabel;

    if (! labelId) {
        return;
    }

    const label = document.getElementById(labelId);

    if (! label) {
        return;
    }

    const emptyText = label.dataset.empty ?? 'Nenhum arquivo selecionado';
    const file = input.files?.[0];

    label.textContent = file?.name ?? emptyText;
});
