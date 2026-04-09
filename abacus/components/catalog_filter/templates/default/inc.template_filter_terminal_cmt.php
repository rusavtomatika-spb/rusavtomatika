<div class="filter_field_block borderless pb-1 pt-1">
    <div class="columns is-gapless is-multiline">
        <div class="column is-12-widescreen is-12-desktop is-12-tablet">
            <input type="checkbox" 
                   id="checkbox_terminal" 
                   value="terminal"
                   @change="filterChanged" 
                   v-model="filterSelectedTerminalCmt"
                   class="terminal_cmt"/>&nbsp;
            <label for="checkbox_terminal">Терминал cMT (iV)</label>
        </div>
    </div>
</div>