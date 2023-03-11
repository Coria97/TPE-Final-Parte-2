{include 'header.tpl'}

<div class="row row-cols-3 g-6">
    <div class="container my-3">
        <div class="card text-center" style="width: 18rem;">
            <div class="col">
                <img src="./images/wip.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{$item["name"]}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{$item["category_name"]}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{$item["description"]}</h6>
                    <p class="card-text">{$item["price"]}</p>
                    <div class="d-grid gap-2">
                        <a href="items" class="btn btn-primary">Volver</a>
                        {if $logged}
                            <form method="POST" action="put_item/{$item["id"]}">
                                <div class="d-grid gap-2">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="name">
                                    <input class="form-control" type="text" id="description" name="description" placeholder="description">
                                    <input class="form-control" type="text" id="price" name="price" placeholder="price">
                                    <select class="form-control" id="fk_id_category" name="fk_id_category">
                                        {foreach from=$categories item=$c}
                                            <option value= "{$c->id}">{$c->name}</option>
                                        {/foreach}
                                    </select>                                    
                                     <button type="submit" class="btn btn-primary">Update item</button>
                                </div>
                            </form>
                            <a href="delete_item/{$item["id"]}" class="btn btn-primary">Delete item</a>
                        {/if}
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>  

{include 'footer.tpl'}
