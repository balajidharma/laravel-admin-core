<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Reaction;

use BalajiDharma\LaravelAdminCore\Data\Reaction\ReactionUpdateData;
use BalajiDharma\LaravelReaction\Models\Reaction;

class ReactionUpdateAction
{
    public function handle(ReactionUpdateData $data, Reaction $reaction)
    {
        return $reaction->update([
            'reaction_name' => $data->getReactionName(),
            'reaction_type' => $data->getReactionType(),
            'rate' => $data->getRate(),
            'reactor_type' => $data->getReactorType(),
            'reactor_id' => $data->getReactorId(),
            'reactable_type' => $data->getReactableType(),
            'reactable_id' => $data->getReactableId(),
            'comment' => $data->getComment(),
        ]);
    }
}
