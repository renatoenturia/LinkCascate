<x-button.delete
    :action="route('links.destroy', $link)"
    :confirm="'Remover o link «'.$link->title.'»? Esta ação não pode ser desfeita.'"
    :label="$buttonLabel ?? 'Excluir link'"
    :size="$buttonSize ?? 'sm'"
    :class="trim(($formClass ?? 'inline').' '.($buttonClass ?? ''))"
/>
