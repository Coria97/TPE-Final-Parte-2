{include 'header.tpl'}

<div class="row row-cols-3 g-6">
  {foreach from=$categories item=$c}
    <div class="container my-3">
      <div class="card text-center" style="width: 18rem;">
        <div class="col">
          <img src="./images/wip.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{$c->name}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{$c->description}</h6>
            <div class="d-grid gap-2">
              <a href="items_x_categories/{$c->id}" class="btn btn-primary">Show items</a>
              {if $logged}
                <form method="POST" action="put_category/{$c->id}">
                  <div class="d-grid gap-2">
                    <input class="form-control" type="text" id="name" name="name" placeholder="name">
                    <input class="form-control" type="text" id="description" name="description" placeholder="description">
                    <button type="submit" class="btn btn-primary">Update category</button>
                  </div>
                </form>
                <a href="delete_category/{$c->id}" class="btn btn-primary">Delete category</a>
              {/if}
            </div>
          </div>
        </div> 
      </div>
    </div>  
  {/foreach}
  {if $logged}
    <div class="container my-3">
      <div class="card text-center" style="width: 18rem;">
        <div class="col-auto">
          <div class="card-body">
            <form method="POST" action="create_category">
              <div class="d-grid gap-2">
                <input class="form-control" type="text" id="name" name="name" placeholder="name">
                <input class="form-control" type="text" id="description" name="description" placeholder="description">
                <button type="submit" class="btn btn-primary">Add category</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  {/if}
</div>

{include 'footer.tpl'}
