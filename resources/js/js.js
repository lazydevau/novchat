import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { List, Avatar } from 'antd';
import { createSlice, configureStore, createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';

const pokeSlice = createSlice({
    name: 'pokemons',
    initialState: {
        pokemons: [],
        status: 'idle',
        error: null,
    },
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(fetchPokemons.pending, (state) => {
                state.status = 'loading';
            })
            .addCase(fetchPokemons.fulfilled, (state, action) => {
                state.status = 'succeeded';
                state.pokemons = action.payload;
            })
            .addCase(fetchPokemons.rejected, (state, action) => {
                state.status = 'failed';
                state.error = action.error.message;
            });
    },
});

const { actions, reducer } = pokeSlice;

export const fetchPokemons = createAsyncThunk('pokemons/fetchPokemons', async () => {
    const response = await axios.get('https://pokeapi.co/api/v2/pokemon?limit=50');
    const { data } = response;
    const pokemons = await Promise.all(data.results.map(async (pokemon) => {
        const spriteResponse = await axios.get(pokemon.url);
        const sprite = spriteResponse.data.sprites.front_default;
        return { name: pokemon.name, sprite };
    }));
    return pokemons;
});

const store = configureStore({
    reducer,
});

function PokemonList() {
    const dispatch = useDispatch();
    const pokemons = useSelector((state) => state.pokemons.pokemons);
    const status = useSelector((state) => state.pokemons.status);

    useEffect(() => {
        if (status === 'idle') {
            dispatch(fetchPokemons());
        }
    }, [status, dispatch]);

    return (
        <div>
            {status === 'loading' && <div>Loading...</div>}
            {status === 'failed' && <div>Error: {error}</div>}
            {status === 'succeeded' && (
                <List
                    itemLayout="horizontal"
                    dataSource={pokemons}
                    renderItem={(pokemon) => (
                        <List.Item>
                            <List.Item.Meta
                                avatar={<Avatar src={pokemon.sprite} />}
                                title={pokemon.name}
                            />
                        </List.Item>
                    )}
                />
            )}
        </div>
    );
}

function App() {
    return (
        <div className="App">
            <PokemonList />
        </div>
    );
}

export default App;
