<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HexaTransaction extends Model
{
    use HasFactory;

    protected $guarded = [];
    

    /**
     * Get the user that owns the HexaTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addHexa(Proposals $proposals,$type="debit")
    {
        $hexaCoin = new self();
        $hexaCoin->user_id = $proposals->user_id;
        $hexaCoin->job_id = $proposals->job_id;
        $hexaCoin->proposal_id = $proposals->id;
        $hexaCoin->hexa_coin = $proposals->jobs->hexa_coin;
        $hexaCoin->type = $type;
        $hexaCoin->save();
    }


    public static function cancelProposal(Proposals $proposals)
    {
        $hexa = HexaTransaction::where('proposal_id',$proposals->id)->first();
        $hexa->is_cancelled = true;
        $hexa->save();
    }
}
