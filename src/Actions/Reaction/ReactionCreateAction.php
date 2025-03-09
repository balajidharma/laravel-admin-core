<?php

namespace BalajiDharma\LaravelAdminCore\Actions\Reaction;

use BalajiDharma\LaravelAdminCore\Data\Reaction\ReactionCreateData;
use BalajiDharma\LaravelReaction\Models\Reaction;

class ReactionCreateAction
{
    public function handle(ReactionCreateData $data)
    {
        return Reaction::create([
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
